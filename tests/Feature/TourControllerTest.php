<?php

namespace Tests\Feature;

use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class TourControllerTest extends TestCase {

    use RefreshDatabase;

    public function test_get_tours() {
        Tour::factory()->count(10)->create();

        $response = $this->getJson('/api/tours');

        $response->assertStatus(Response::HTTP_OK)
                ->assertJsonCount(10, 'data');
    }
}
