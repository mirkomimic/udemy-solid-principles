<?php

namespace App\Services;

class SoftCopiesOrderManager extends BaseOrderManager
{
  public function process()
  {
    return (object) [
      'delivery' => 'Here is your download link',
      'paid' => round($this->total, 2)
    ];
  }
}
