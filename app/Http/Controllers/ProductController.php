<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use App\Traits\ProductTrait;
use Intervention\Image\Facades\Image;
use Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ProductTrait;

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function getProducts(Request $request)
    {
        if ($request->ajax()) {
            $allProducts = $this->allProducts();
            if (! isset($request->page)) {
                return view('admin.pages.admin_products', compact('allProducts'));
            }

            return view('admin.pages.products_includes.products_table', compact('allProducts'));
        }
    }

    public function productDisplay($id, $modelType)
    {
        if ($id != 0) {
            $data = $this->getProductById($id);
        }
        if ($modelType === 'show') {
            return view('admin.pages.products_includes.models_includes.products_model_show', compact('data'));
        } elseif ($modelType === 'edit') {
            return view('admin.pages.products_includes.models_includes.products_model_edit', compact('data'));
        } elseif ($modelType === 'create') {
            return view('admin.pages.products_includes.models_includes.products_model_create');
        }
    }

    public function productCreate(Request $request)
    {
        $validator = $this->checkRequest($request, ['image'], ['image|mimes:jpeg,bmp,png']);

        if ($validator->fails()) {
            return view('admin.pages.products_includes.models_includes.products_model_create')
                ->withErrors($validator);
        }

        $filename = $this->saveImageAndGetFilename($request);

        Product::create(array_except($request->all(), ['image']));
        $product = Product::select('id')->orderBy('id', 'desc')->first();
        ProductImage::create(['product_photo' => $filename, 'product_id' => $product->id]);
        return view('admin.pages.products_includes.models_includes.products_model_create')
            ->withStatus('The product has been created successfully!');
    }

    public function productUpdate(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $validator = $this->checkRequest($request, ['image'], ['image|mimes:jpeg,bmp,png']);
        } else {
            $validator = $this->checkRequest($request);
        }

        if ($validator->fails()) {
            $data = Product::findOrFail($id);
            return view('admin.pages.products_includes.models_includes.products_model_edit', compact('data'))
                    ->withErrors($validator);
        }

        $filename = $this->saveImageAndGetFilename($request);

        Product::findOrFail($id)->update(array_except($request->all(), ['image']));
        $data = Product::findOrFail($id);
        if ($request->hasFile('image')) {
            ProductImage::where('product_id', $id)->delete();
            ProductImage::create(['product_photo' => $filename, 'product_id' => $id]);
        }
        return view('admin.pages.products_includes.models_includes.products_model_edit', compact('data'))
                ->withStatus('Product data has been updated successfully!');
    }

    public function productPublish($id)
    {
        $this->publish($id);
    }

    public function productRemove($id)
    {
        $this->remove($id);
    }

    public function productSearch($productId)
    {
        if ($productId === 'none') {
            $allProducts = $this->allProducts();
            return view('admin.pages.products_includes.products_table', compact('allProducts'));
        } elseif (is_numeric($productId) && $productId >= 1) {
            $allProductsFromSearch = $this->getProductById($productId);

            if (count($allProductsFromSearch)) {
                return view('admin.pages.products_includes.products_table_search_result', compact('allProductsFromSearch'))
                    ->withStatus(count($allProductsFromSearch) . ' found it.');
            } else {
                return view('admin.pages.products_includes.products_table_search_result', compact('allProductsFromSearch'))
                    ->withStatus('No results found it');
            }
        }
    }
}
