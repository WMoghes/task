<?php

namespace App\Http\Controllers;

use App\Traits\GuestTrait;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    use GuestTrait;

    /**
     * return view contain all published products with max and min price
     * @param Request $request
     * @param int $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $type = 0)
    {
        $data = $this->homePageData();
        $allPublishedProducts = $data['allPublishedProducts'];
        $max = $data['max'];
        $min = $data['min'];

        if ($request->ajax() && $type == 1) {
            return view('welcome', compact('allPublishedProducts', 'min', 'max'));
        } elseif ($request->ajax() && $type == 0) {
            return view('site_includes.thumbnail_for_products', compact('allPublishedProducts', 'min', 'max'));
        }
        return view('welcome', compact('allPublishedProducts', 'min', 'max'));
    }

    /**
     * return all product according to (product name or category name) and product price
     * Route('search')
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
//        dd($this->getResult($request));
        return view('site_includes.thumbnail_for_products')->with([
                    'allPublishedProducts' => $this->getResult($request)
                ]);
    }

    /**
     * return view contain product data
     * Route('display-product/{id}')
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function displayProduct($id)
    {
        $allData = $this->productData($id);
        $data = $allData['productData'];
        $productPhoto = $allData['productPhoto'];

        return view('site_includes.display_product', compact('data', 'productPhoto'));
    }
}
