<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class OrderProcessTest extends TestCase
{
  use RefreshDatabase;

  public function test_a_user_order_can_be_processed(): void
  {
    // $this->assertTrue(true);
    // set up the world
    $product = Product::factory()->create();
    $stock = Stock::factory()->create([
      'product_id' => $product->id
    ]);

    $response = $this->post("/api/order/{$product->id}/process", [
      'payment_method' => 'stripe',
    ])->assertOk()->json();

    $this->assertArrayHasKey('payment_message', $response);
    $this->assertArrayHasKey('discounted_price', $response);
    $this->assertArrayHasKey('original_price', $response);
    $this->assertArrayHasKey('message', $response);

    $this->assertDatabaseHas('stocks', [
      'quantity' => $stock->quantity - 1
    ]);
  }

  public function test_an_exception_is_thrown_when_product_is_out_of_stock(): void
  {
    $this->expectException(ValidationException::class);

    $product = Product::factory()->create();
    $stock = Stock::factory()->create([
      'quantity' => 0,
      'product_id' => $product->id
    ]);

    $this->withoutExceptionHandling()->post("/api/order/{$product->id}/process", [
      'payment_method' => 'stripe',
    ]);
  }
}
