<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Services\BrandService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** @var  Product */
    private $service;
    private $brandService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductService $service, BrandService $brandService)
    {
        $this->service = $service;
        $this->brandService = $brandService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $products = $this->service->getProducts($request->all());
        $brands = $this->brandService->getBrands();
        return view('client.home', compact('products', 'brands'));
    }
}
