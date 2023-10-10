<?php

namespace App\Services;

class HardCopiesOrderManager extends BaseOrderManager implements Shippable
{
  public function shipping(int $shipping)
  {
    $this->total += $shipping;
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
