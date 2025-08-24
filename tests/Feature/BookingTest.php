<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Package;
use App\Models\User;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads_successfully()
    {
        // Create test package manually
        Package::create([
            'name' => 'Test Package',
            'slug' => 'test-package',
            'description' => 'Test description',
            'price' => 5000,
            'duration' => 60,
            'max_participants' => 2,
            'is_active' => true,
            'featured' => true
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_api_route_exists()
    {
        $response = $this->get('/api/v1/packages');
        $response->assertStatus(200);
    }
}
