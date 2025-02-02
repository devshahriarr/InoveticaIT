<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $user = User::factory()->create(); // Create a user
        $this->actingAs($user); // Authenticate the user

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
