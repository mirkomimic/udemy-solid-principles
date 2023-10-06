<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
  use RefreshDatabase;

  public function test_a_user_can_browse_all_products(): void
  {
    $products = Product::factory(10)->create();

    $response = $this->get('/')->assertOk();

    $data = $response->viewData('products');

    $this->assertSame($products->count(), $data->count());
    $this->assertInstanceOf(Product::class, $data->first());
  }
}
