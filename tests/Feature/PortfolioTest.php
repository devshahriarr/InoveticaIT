<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Portfolio;
use App\Models\User;

class PortfolioTest extends TestCase
{
    use RefreshDatabase; // reset database after each test
    /**
     * A basic feature test example.
     */

     #[Test]
    public function it_can_create_a_portfolio()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/backend/portfolio/add', [
            'name' => 'My Portfolio',
            'url' => 'https://example.com',
            'description' => 'Portfolio description',
            'image' => UploadedFile::fake()->image('portfolio.jpg'),
        ]);

        $response->assertStatus(200)
                 ->assertJson(['status' => 200, 'message' => 'portfolio Save Successfully']);

        $this->assertDatabaseHas('portfolios', ['title' => 'My Portfolio']);
    }

    #[Test]
    public function it_can_list_portfolios()
    {
        Portfolio::factory()->count(3)->create();

        $response = $this->getJson('/backend/portfolio/data');

        $response->assertStatus(200)
                 ->assertJsonStructure(['status', 'data']);
    }

    #[Test]
    public function it_can_update_a_portfolio()
    {
        $portfolio = Portfolio::factory()->create();

        $response = $this->postJson("/backend/portfolio/update/{$portfolio->id}", [
            'name' => 'Updated Portfolio',
            'url' => 'https://updated-example.com',
            'description' => 'Updated description',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['status' => 200, 'message' => 'portfolio Update Successfully']);

        $this->assertDatabaseHas('portfolios', ['title' => 'Updated Portfolio']);
    }

    #[Test]
    public function it_can_delete_a_portfolio()
    {
        $portfolio = Portfolio::factory()->create();

        $response = $this->getJson("/backend/portfolio/destroy/{$portfolio->id}");

        $response->assertStatus(200)
                 ->assertJson(['status' => 200, 'message' => 'portfolio Deleted Successfully']);

        $this->assertDatabaseMissing('portfolios', ['id' => $portfolio->id]);
    }
}
