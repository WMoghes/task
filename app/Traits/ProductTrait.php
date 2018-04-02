<?php

namespace App\Traits;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Validator;

trait ProductTrait {

    public function allProducts()
    {
        return Product::orderBy('id', 'desc')->paginate(6);
    }

    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    public function checkRequest($request, Array $keys = [], Array $values = [])
    {
        $arrOfKeys = [
            'product_name', 'product_price', 'product_description', 'product_quantity', 'product_admin_verify', 'category_id'
        ];
        $arrOfValues = [
            'required|min:4|max:30',
            'required|integer',
            'required|min:10',
            'required|integer',
            'required|integer',
            'required|integer',
        ];
        if (count($keys) && count($values)) {
            for ($i = 0, $len = count($values); $i < $len; $i++) {
                array_push($arrOfValues, $values[$i]);
            }

            for ($i = 0, $len = count($keys); $i < $len; $i++) {
                array_push($arrOfKeys, $keys[$i]);
            }
        }
        return Validator::make($request->all(), array_combine($arrOfKeys, $arrOfValues));
    }

    public function saveImageAndGetFilename($request)
    {
        if ($request->hasFile('image')) {
            $cover = $request->file('image');
            $filename = time() . '.' . $cover->getClientOriginalExtension();
            $path = public_path('assets/uploads/' . $filename);
            Image::make($cover)->save($path);
            return $filename;
        }
    }

    public function publish($id)
    {
        $product = Product::findOrFail($id);
        $product->product_admin_verify = $product->product_admin_verify === 1 ? '0' : '1';
        $product->update();
    }

    public function remove($id)
    {
        Product::findOrFail($id)->delete();
        ProductImage::where('product_id', $id)->delete();
    }
}