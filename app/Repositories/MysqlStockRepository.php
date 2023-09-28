<?php

namespace App\Repositories;

use App\Repositories\Contracts\StockRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MysqlStockRepository implements StockRepositoryInterface
{
  public const MINIMUM_STOCK_LEVEL = 1;

  public function forProduct($product_id)
  {
    return DB::table('stocks')->where('product_id', $product_id)->first();
  }

  public function checkAvailibility($stock)
  {
    if ($stock->quantity < self::MINIMUM_STOCK_LEVEL) {
      throw ValidationException::withMessages([
        'stock' => ['we are out of stock']
      ]);
    }

    return $stock;
  }

  public function record($product_id)
  {
    $stock = DB::table('stocks')
      ->where('product_id', $product_id);

    // $stock = $this->forProduct($product_id);

    $stock->update([
      'quantity' => $stock->first()->quantity - 1
    ]);
  }
}
