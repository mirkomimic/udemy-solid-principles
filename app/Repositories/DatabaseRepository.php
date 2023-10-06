<?php

namespace App\Repositories;

use App\Models\Product;

class DatabaseRepository extends Repository
{
  public function all()
  {
    return Product::all();
  }
}
