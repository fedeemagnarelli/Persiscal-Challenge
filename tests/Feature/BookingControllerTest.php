<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class BookingControllerTest extends TestCase {

    use RefreshDatabase;

    public function test_get_bookings() {
        Booking::factory()->count(10)->create();

        $response = $this->getJson('/api/bookings');

        $response->assertStatus(Response::HTTP_OK)
                ->assertJsonCount(10, 'data');
    }

    public function test_filter_by_hotel_name() {
        $hotel = Hotel::factory()->create(['name' => 'Hotel Test']);
        Booking::factory()->create(['id' => $hotel->id]);

        $response = $this->getJson('/api/bookings?hotel_name=Hotel Test');

        $response->assertStatus(Response::HTTP_OK)
                ->assertJsonCount(1, 'data')
                ->assertJsonFragment(['id' => $hotel->id]);
    }

    public function test_filter_by_tour_name() {
        $tour = Tour::factory()->create(['name' => 'Tour Test']);
        Booking::factory()->create(['id' => $tour->id]);

        $response = $this->getJson('/api/bookings?tour_name=Tour Test');

        $response->assertStatus(Response::HTTP_OK)
                ->assertJsonCount(1, 'data')
                ->assertJsonFragment(['id' => $tour->id]);
    }

    public function test_filter_between_dates() {
        Booking::factory()->create(['booking_date' => '2024-07-01']);
        Booking::factory()->create(['booking_date' => '2024-07-02']);
        Booking::factory()->create(['booking_date' => '2024-07-03']);

        $response = $this->getJson('/api/bookings?start_date=2024-07-01&end_date=2024-07-03');

        $response->assertStatus(Response::HTTP_OK)
                ->assertJsonCount(3, 'data');
    }

    public function test_filter_order_by() {
        Booking::factory()->create(['customer_name' => 'Cliente Test 1']);
        Booking::factory()->create(['customer_name' => 'Cliente Test 2']);
        Booking::factory()->create(['customer_name' => 'Cliente Test 3']);

        $response = $this->getJson('/api/bookings?order_by=customer_name&order_direction=desc');
        
        $response->assertStatus(Response::HTTP_OK)
                ->assertJsonCount(3, 'data')
                ->assertJsonFragment(['customer_name' => 'Cliente Test 3']);
    }

    public function cancel_booking_test() {
        $booking = Booking::factory()->create();

        $response = $this->deleteJson('/api/bookings/'.$booking->id.'/cancel');

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }

    public function export_bookings_test() {
        Booking::factory()->count(10)->create();

        $response = $this->getJson('/api/bookings/export');

        $response->assertStatus(Response::HTTP_OK)
                ->assertHeader('Content-Type', 'text/csv')
                ->assertDownload('reservas.csv');
    }

}