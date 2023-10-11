<?php

namespace App\Services;

class StripePaymentService implements Payable
{
  public function process($total)
  {
    $price = "£{$total}";
    return 'Processing payment of ' . $price . ' through Stripe';
  }
}
