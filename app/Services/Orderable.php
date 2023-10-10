<?php

namespace App\Services;

interface Orderable
{
  public function calculate();

  public function shipping(int $shipping);

  public function discount($discount);

  public function delivery($company);

  public function process();
}
