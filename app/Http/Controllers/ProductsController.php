<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DatabaseRepository;

class ProductsController extends Controller
{
  public function index(DatabaseRepository $repository)
  {
    $products = $repository->all();

    return view('welcome', ['products' => $products]);
  }
}
