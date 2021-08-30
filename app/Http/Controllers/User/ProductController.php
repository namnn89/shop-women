<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;

class ProductController extends Controller
{
    /** @var  Product */
    private $product;
    private $brand;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product, Brand $brand)
    {
        $this->product = $product;
        $this->brand = $brand;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail($id)
    {
        $product = $this->product->with(['media'])->find($id);
        $brands = $this->brand->all();
        return view('client.detail', compact('product', 'brands'));
    }
}
