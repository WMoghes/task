<?php

namespace App\Http\Controllers;

use App\Traits\GuestTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiGuestController extends Controller
{
    use GuestTrait;

    /**
     * return json contain all published products with max and min price
     * @return Response <json>
     */
    public function index()
    {
        $data = $this->homePageData();
        $allPublishedProducts = $data['allPublishedProducts'];
        $max = $data['max'];
        $min = $data['min'];


        return Response::json([
           'allPublishedProducts' => json_encode($allPublishedProducts),
            'max' => $max,
            'min' => $min
        ]);
    }

    /**
     * return all product according to (product name or category name) and product price
     * Route('api/search')
     * @param Request $request
     * @return Response <json>
     */
    public function search(Request $request)
    {
        return Response::json([
            'data' => json_encode($this->getResult($request))
        ]);
    }

    /**
     * return json contain product data
     * Route('api/display-product/{id}')
     * @param $id
     * @return Response <json>
     */
    public function displayProduct($id)
    {
        $allData = $this->productData($id);
        $data = $allData['productData'];
        $productPhoto = $allData['productPhoto'];

        return Response::json([
            'data' => [
                'productData' => $data,
                'productPhoto' => $productPhoto
            ]
        ]);
    }
}
