<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;

class ApiRepository extends Repository
{
  public function all(): Collection
  {
    $products = File::get(storage_path('products.json'));
    $products = json_decode($products, true);
    // hydrate pretvara niz u eloquent model
    $products = Product::hydrate($products);
    return $products;
  }
}
