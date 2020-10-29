<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->limit(6)->orderBy('id', 'DESC')->get();
        $stores = \App\Store::limit(1)->get();

        return view('welcome', compact('products', 'stores'));
    }

    public function single($slug)
    {
        $product = $this->product->where('slug', $slug)->first();

        return view('single', compact('product'));
    }
}
