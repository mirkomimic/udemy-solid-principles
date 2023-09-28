<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Patterns\Discounts\TwentyPercentDiscount;
use App\Patterns\Discounts\FiftyPercentDiscount;
use App\Services\DiscountService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class DiscountServiceTest extends TestCase
{
  use RefreshDatabase;

  public function test_it_applies_20_percent_discount()
  {
    $product = Product::factory()->make([
      'price' => 40,
    ]);

    $discountService = new DiscountService(new TwentyPercentDiscount);
    $total = $discountService->with($product)->apply();

    $this->assertSame(32, intval($total));
  }

  public function test_it_applies_50_percent_discount()
  {
    $product = Product::factory()->make([
      'price' => 40,
    ]);

    $discountService = new DiscountService(new FiftyPercentDiscount);
    $total = $discountService->with($product)->apply();

    $this->assertSame(20, intval($total));
  }

  public function test_it_applies_20_percent_discount_if_service_id_instantiated_through_make_method()
  {
    $product = Product::factory()->make([
      'price' => 40,
    ]);

    // $discountService = new DiscountService(new FiftyPercentDiscount);
    $total = DiscountService::make(new TwentyPercentDiscount)->with($product)->apply();

    $this->assertSame(32, intval($total));
  }
}
