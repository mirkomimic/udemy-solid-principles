<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

abstract class Repository
{
  abstract public function all(): Collection;
}
