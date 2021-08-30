<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Services\BrandService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

/**
 * Class ProductController
 * @package App\Http\Controllers\Admin
 */
class ProductController extends AppBaseController
{
    /**
     * @var ProductService
     */
    private $service;

    /**
     * @var BrandService
     */
    private $brandService;

    /**
     * ProductController constructor.
     * @param ProductService $service
     * @param BrandService $brandService
     */
    public function __construct(ProductService $service, BrandService $brandService)
    {
        $this->service = $service;
        $this->brandService = $brandService;
    }

    /**
     * Display a listing of the Product.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $products = $this->service->getProducts();

        return view('admin.products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        $brands = $this->getBrandDataArray();
        return view('admin.products.create', compact('brands'));
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(StoreProductRequest $request)
    {
        $this->service->createProduct($request);

        Flash::success('Product saved successfully.');

        return redirect(route('products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->service->getProduct($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->service->getProduct($id);

        $brands = $this->getBrandDataArray();

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('admin.products.edit', compact('product', 'brands'));
    }

    /**
     * @param $id
     * @param StoreProductRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Product $id, StoreProductRequest $request)
    {
        $this->service->updateProduct($id, $request);

        Flash::success('Product updated successfully.');

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }

    /**
     * @return array
     */
    private function getBrandDataArray() {
        $brands = $this->brandService->getBrands();
        $arr_brands = [];
        foreach ($brands as $brand) {
            $arr_brands[$brand->id] = $brand->name;
        }

        return $arr_brands;
    }
}
