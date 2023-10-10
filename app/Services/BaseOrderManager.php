<?php

namespace App\Services;

abstract class BaseOrderManager implements Orderable
{
  protected $total;
  protected $items;
  protected $deliveryMessage;

  public function __construct($items = [])
  {
    $this->items = $items;
  }

  public function calculate()
  {
    $this->total = collect($this->items)->sum('price');
    return $this;
  }

  public function discount($discount = 0.02)
  {
    $this->total -= $this->total * $discount;
    return $this;
  }

  abstract public function process();
}
