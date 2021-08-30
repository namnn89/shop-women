<?php

namespace App\Services;

use App\Repositories\MediaRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var MediaRepository
     */
    protected $mediaRepository;

    /**
     * ProductService constructor.
     * @param ProductRepository $productRepository
     * @param MediaRepository $mediaRepository
     */
    public function __construct(ProductRepository $productRepository, MediaRepository $mediaRepository)
    {
        $this->productRepository = $productRepository;
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function getProducts($params = []) {
        return $this->productRepository->getProducts($params);
    }

    /**
     * @param $id
     * @return Collection
     */
    public function getProduct($id) {
        return $this->productRepository->find($id);
    }

    public function createProduct($request) {
        $productData = $request->validated();
        if (isset($productData['images'])) {
            unset($productData['images']);
        }

        $product = $this->productRepository->create($productData);
        $this->handleProcessImageUpload($request->images ?? [], $product->id);
    }

    private function handleProcessImageUpload($files, $productId) {
        foreach ($files as $file) {
            $save_path = public_path('products');
            if (!file_exists($save_path)) {
                mkdir($save_path, 0755, true);
            }

            $mime = $file->getMimeType();
            $ext = explode('/', $mime);
            $filename = uniqid('products') . '.' . $ext[1];

            $file->move($save_path, $filename);

            $this->mediaRepository->create([
                'product_id' => $productId,
                'file_name' => $filename
            ]);
        }
    }

    public function removeImage($images) {
        if (!$images) {
            return true;
        }

        $images = explode(",",$images);
        foreach ($images as $image) {
            $media = $this->mediaRepository->find($image);
            $media->delete();
        }
    }

    public function updateProduct($product, $request) {
        $data = $request->only([
            'name',
            'desc',
            'price',
        ]);

        $product->fill($data)->save();

        $this->handleProcessImageUpload($request->images ?: [], $product->id);
        $this->removeImage($request->remove_images);
    }

    public function delete($id) {
        $this->productRepository->delete($id);
    }
}
