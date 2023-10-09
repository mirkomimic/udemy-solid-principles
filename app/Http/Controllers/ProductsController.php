<?php

namespace App\Http\Controllers;

use App\Repositories\ApiRepository;
use Illuminate\Http\Request;
use App\Repositories\DatabaseRepository;

class ProductsController extends Controller
{
  public function index(ApiRepository $repository)
  {
    $products = $repository->all();

    return view('welcome', ['products' => $products]);
  }
}
