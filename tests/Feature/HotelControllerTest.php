<?php

namespace Tests\Feature;

use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class HotelControllerTest extends TestCase {

    use RefreshDatabase;

    public function test_get_hotels() {
        Hotel::factory()->count(10)->create();

        $response = $this->getJson('/api/hotels');

        $response->assertStatus(Response::HTTP_OK)
                ->assertJsonCount(10, 'data');
    }
}