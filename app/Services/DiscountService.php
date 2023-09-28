<?php

namespace App\Services;

use App\Patterns\Discounts\Discountable;

class DiscountService
{
  protected $product;
  protected Discountable $discountable;

  public function __construct(Discountable $discountable)
  {
    $this->discountable = $discountable;
  }

  public static function make(Discountable $discountable)
  {
    return new static($discountable);
  }

  public function with($product)
  {
    $this->product = $product;
    return $this;
  }

  public function apply()
  {
    return $this->discountable->apply($this->product);
  }
}
