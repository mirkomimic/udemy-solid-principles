<?php

namespace App\Repositories;

use Illuminate\Support\Facades\File;

class ApiRepository extends Repository
{
  public function all()
  {
    $products = File::get(storage_path('products.json'));
    $products = json_decode($products, true);
    return $products;
  }
}
