<?php

namespace App\Services;

interface Shippable
{
  public function delivery($company);

  public function shipping(int $shipping);
}
