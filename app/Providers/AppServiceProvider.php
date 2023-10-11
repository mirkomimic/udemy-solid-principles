<?php

namespace App\Providers;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\StockRepositoryInterface;
use App\Repositories\MysqlProductRepository;
use App\Repositories\MysqlStockRepository;
use App\Services\Payable;
use App\Services\StripePaymentService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  // public $bindings = [
  //   ProductRepositoryInterface::class => MysqlProductRepository::class,
  //   StockRepositoryInterface::class => MysqlStockRepository::class
  // ];

  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->bind(ProductRepositoryInterface::class, MysqlProductRepository::class);
    $this->app->bind(StockRepositoryInterface::class, MysqlStockRepository::class);
    $this->app->bind(Payable::class, StripePaymentService::class);
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}
