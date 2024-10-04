<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_creation()
    {
        $data = [
            'name' => 'Test Product',
            'description' => 'A great product',
            'price' => 100.00,
        ];

        $response = $this->postJson('/api/products', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('products', $data);
    }

    public function test_product_search()
    {
        Product::factory()->create([
            'name' => 'Test Product',
            'description' => 'A great product',
            'price' => 100.00,
        ]);

        $response = $this->get('/api/products/search?q=Test');
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Test Product']);
    }
}
