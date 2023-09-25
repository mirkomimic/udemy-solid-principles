<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\StockRepository;
use App\Services\StripePaymentService;
use App\Repositories\ProductRepository;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderProcessingService
{
  /** @var ProductRepository */
  protected $productRepository;

  /** @var StockRepository */
  protected $stockRepository;

  /** @var DiscountService */
  protected $discountService;

  protected StripePaymentService $stripePaymentService;

  public function __construct(
    ProductRepository $productRepository,
    StockRepository $stockRepository,
    DiscountService $discountService,
    StripePaymentService $stripePaymentService
  ) {
    $this->productRepository = $productRepository;
    $this->stockRepository = $stockRepository;
    $this->discountService = $discountService;
    $this->stripePaymentService = $stripePaymentService;
  }

  public function execute($product_id)
  {
    $product = $this->productRepository->getById($product_id);

    $stock = $this->stockRepository->forProduct($product_id);

    // check the stock level
    $this->stockRepository->checkAvailibility($stock);

    $total = $this->discountService->with($product)->applySpecialDiscount();

    $paymentSuccessMessage = $this->stripePaymentService->process($total);

    $this->stockRepository->record($product_id);

    return [
      'payment_message' => $paymentSuccessMessage,
      'discounted_price' => $total,
      'original_price'  => $product->price,
      'message' => 'Thank you, your order is being processed'
    ];
  }
}
