<?php

namespace App\Services;

interface Orderable
{
  public function calculate();

  public function discount($discount);

  public function process();
}
