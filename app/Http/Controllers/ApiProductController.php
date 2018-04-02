<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use App\Traits\ProductTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Response;

class ApiProductController extends Controller
{
    use ProductTrait;

    /**
     * Return object contain all data for user and null if the user not logged in
     * @param $request
     * @return null|object
     */
    private function checkUserLoggedIn($request)
    {
        if (isset($request->token)) {
            return JWTAuth::parseToken()->authenticate();
        } else {
            return null;
        }
    }

    /**
     * return response
     * @param array $arr
     * @param int $statusNumber
     * @return string <json>
     */
    private function productResponse(Array $arr, $statusNumber = 200)
    {
        return Response::json([$arr], $statusNumber);
    }

    /**
     * return all products
     * Route('admin/api/products')
     * @param Request $request
     * @return string <json>
     */
    public function getProducts(Request $request)
    {
        if (is_null($this->checkUserLoggedIn($request))) {
            $this->productResponse([
                'error' => '1',
                'message' => 'You should login to access this page.'
            ]);
        }
        dd(json_encode($this->allProducts()));
        $this->productResponse([
            'allProducts' => json_encode($this->allProducts())
        ]);
    }

    /**
     * return product data by using product id
     * Route('admin/api/product/{id}')
     * @param $id
     * @param Request $request
     * @return string <json>
     */
    public function productDisplay(Request $request, $id)
    {
        if (is_null($this->checkUserLoggedIn($request))) {
            $this->productResponse([
                'error' => '1',
                'message' => 'You should login to access this page.'
            ]);
        }
        $this->productResponse([
            'product' => json_encode($this->getProductById($id))
        ]);
    }

    /**
     * create a new product
     * Route('admin/api/product-create')
     * @param Request $request
     * @return string <json>
     */
    public function productCreate(Request $request)
    {
        if (is_null($this->checkUserLoggedIn($request))) {
            $this->productResponse([
                'error' => '1',
                'message' => 'You should login to access this page.'
            ]);
        }
        $validator = $this->checkRequest($request, ['image'], ['image|mimes:jpeg,bmp,png']);

        if ($validator->fails()) {
            $this->productResponse([
                'errors' => $validator->errors()
            ]);
        }

        $filename = $this->saveImageAndGetFilename($request);

        Product::create(array_except($request->all(), ['image']));
        $product = Product::select('id')->orderBy('id', 'desc')->first();
        ProductImage::create(['product_photo' => $filename, 'product_id' => $product->id]);

        $this->productResponse([
            'error' => 0,
            'product' => json_encode($product)
        ]);
    }

    /**
     * update data for one product by using product id
     * Route('admin/api/product-update/{id}')
     * @param Request $request
     * @param $id
     * @return string <json>
     */
    public function productUpdate(Request $request, $id)
    {
        if (is_null($this->checkUserLoggedIn($request))) {
            $this->productResponse([
                'error' => '1',
                'message' => 'You should login to access this page.'
            ]);
        }
        if ($request->hasFile('image')) {
            $validator = $this->checkRequest($request, ['image'], ['image|mimes:jpeg,bmp,png']);
        } else {
            $validator = $this->checkRequest($request);
        }

        if ($validator->fails()) {
            $this->productResponse([
                'errors' => $validator->errors()
            ]);
        }

        $filename = $this->saveImageAndGetFilename($request);

        Product::findOrFail($id)->update(array_except($request->all(), ['image']));
        $data = Product::findOrFail($id);
        if ($request->hasFile('image')) {
            ProductImage::where('product_id', $id)->delete();
            ProductImage::create(['product_photo' => $filename, 'product_id' => $id]);
        }

        $this->productResponse([
            'data' => $data
        ]);
    }

    /**
     * publish one product by using product id
     * Route('admin/api/product-publish/{id}')
     * @param Request $request
     * @param $id
     * @return string <json>
     */
    public function productPublish(Request $request, $id)
    {
        if (is_null($this->checkUserLoggedIn($request))) {
            $this->productResponse([
                'error' => '1',
                'message' => 'You should login to access this page.'
            ]);
        }
        $this->publish($id);

        $this->productResponse([
            'error' => 0
        ]);
    }

    /**
     * remove one product by using product id
     * Route('admin/api/product-remove/{id}')
     * @param Request $request
     * @param $id
     * @return string <json>
     */
    public function productRemove(Request $request, $id)
    {
        if (is_null($this->checkUserLoggedIn($request))) {
            $this->productResponse([
                'error' => '1',
                'message' => 'You should login to access this page.'
            ]);
        }
        $this->remove($id);

        $this->productResponse([
            'error' => 0
        ]);
    }

    /**
     * get product data by using product id
     * Route('admin/api/product-search/{productId}')
     * @param $productId
     * @return string <json>
     */
    public function productSearch($productId)
    {
        if ($productId === 'none') {
            $this->productResponse([
                'allProducts' => json_encode($this->allProducts())
            ]);
        } elseif (is_numeric($productId) && $productId >= 1) {
            $this->productResponse([
                'productId' => json_encode($this->getProductById($productId))
            ]);
        }
    }
}
