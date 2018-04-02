<?php

namespace App\Traits;

use App\Product;
use Illuminate\Http\Request;

trait GuestTrait {

    /**
     * return all published products with max and min price
     * @return array
     */
    public function homePageData()
    {
        $allPublishedProducts = Product::published()->orderBy('id', 'desc')->paginate(6);
        $max = Product::maxPrice();
        $min = Product::minPrice();

        return [
            'allPublishedProducts' => $allPublishedProducts,
            'max' => $max,
            'min' => $min
        ];
    }

    /**
     * return collection of data according to request (productName or productPrice)
     * @param Request $request
     * @return object
     */
    public function getResult(Request $request)
    {
        $query = Product::select('products.id', 'products.product_name', 'products.product_price', 'products.product_description', 'products.product_details', 'products.product_quantity', 'products.category_id', 'products.product_admin_verify', 'categories.category_name', 'product_images.product_id', 'product_images.product_photo');
        $query = $this->joinWithCategories($query);
        $query = $this->joinWithPhotos($query);
        $query = $this->productNameQuery($query, $request->product_name);
        if (is_numeric($request->price_to) && is_numeric($request->price_from)) {
            $query = $this->productPriceQuery($query, [$request->price_from, $request->price_to]);
        }

        return $query->published()->orderBy('products.id', 'desc')->paginate(6);
    }

    /**
     * used to make join with categories table
     * @param $query
     * @return string <query>
     */
    private function joinWithCategories($query)
    {
        return $query->join('categories', 'products.category_id', '=', 'categories.id');
    }

    /**
     * used to make left join with product photos
     * @param $query
     * @return string <query>
     */
    private function joinWithPhotos($query)
    {
        return $query->leftJoin('product_images', 'products.id', '=', 'product_images.product_id')
            ->whereNull('product_images.deleted_at');
    }

    /**
     * to search in product name and category name
     * @param $query
     * @param $productName
     * @return string <query>
     */
    private function productNameQuery($query, $productName)
    {
        return $query->where(function ($query) use ($productName) {
            $query->orWhere('products.product_name', 'like', '%' . $productName . '%')
                ->orWhere('categories.category_name', 'like', '%' . $productName . '%');
        });
    }

    /**
     * to search in product price
     * @param $query
     * @param array $productPrice
     * @return string <query>
     */
    private function productPriceQuery($query, Array $productPrice)
    {
        return $query->whereBetween('products.product_price', $productPrice);
    }

    /**
     * return product data with photo name
     * @param $id
     * @return array
     */
    public function productData($id)
    {
        $data = Product::findOrFail($id);
        $productPhoto = isset($data->images) ? $data->images : null;

        return [
            'productData' => $data,
            'productPhoto' => $productPhoto
        ];
    }
}