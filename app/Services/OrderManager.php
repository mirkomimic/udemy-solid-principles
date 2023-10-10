<?php

namespace App\Services;

class OrderManager implements Orderable
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

  public function shipping(int $shipping)
  {
    $this->total += $shipping;
    return $this;
  }

  public function discount($discount = 0.02)
  {
    $this->total -= $this->total * $discount;
    return $this;
  }

  public function delivery($company)
  {
    $this->deliveryMessage = 'Delivery will be made by ' . $company;
    return $this;
  }

  public function process()
  {
    return (object) [
      'delivery' => $this->deliveryMessage,
      'paid' => round($this->total, 2)
    ];
  }
}
