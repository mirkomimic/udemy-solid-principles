<?php

namespace App\Services;

interface Payable
{
  public function process($total);
}
