<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function getOrders(Request $request)
    {
        if ($request->ajax()) {
            $allOrders = Order::orderBy('id', 'desc')->paginate(6);
            if (! isset($request->page)) {
                return view('admin.pages.admin_orders', compact('allOrders'));
            }

            return view('admin.pages.orders_includes.orders_table', compact('allOrders'));
        }
    }

    public function getOrderById($id)
    {
        $data = Order::findOrFail($id);
        return view('admin.pages.orders_includes.models_includes.orders_model_show', compact('data'));
    }

    public function changeOrderStatus($id, $orderStatus)
    {
        if (is_numeric($id) && is_numeric($orderStatus)) {
            Order::findOrFail($id)->update([
                'order_status' => $orderStatus
            ]);
        }
    }

    public function orderSearch($id)
    {
        if ($id === 'none') {
            $allOrders = Order::orderBy('id', 'desc')->paginate(6);
            return view('admin.pages.orders_includes.orders_table', compact('allOrders'));
        } elseif (is_numeric($id) && $id >= 1) {
            $allOrdersFromSearch = Order::findOrFail($id);

            if (count($allOrdersFromSearch)) {
                return view('admin.pages.orders_includes.orders_table_search_result', compact('allOrdersFromSearch'))
                    ->withStatus(count($allOrdersFromSearch) . ' found it.');
            } else {
                return view('admin.pages.orders_includes.orders_table_search_result', compact('allOrdersFromSearch'))
                    ->withStatus('No results found it');
            }
        }
    }

    public function getShoppingCart()
    {
        if (Auth::check()) {
            $shoppingCart = Session::get('cart_' . Auth::user()->id);
            $data = Product::whereIn('id', $shoppingCart)->get();
            return view('client.shopping_cart', compact('data'));
        }
    }

    public function addToCart($id)
    {
        if (Auth::check()) {
            $this->addValueInSession('cart_' . Auth::user()->id, decryptText($id));
            return count(Session::get('cart_' . Auth::user()->id));
        }
    }

    public function removeFromCart($id)
    {
        if (Auth::check()) {
            if (Session::has('cart_' . Auth::user()->id)) {
                $shoppingCart = Session::get('cart_' . Auth::user()->id);

                if (($key = array_search($id, $shoppingCart)) !== false) {
                    unset($shoppingCart[$key]);
                }
                Session::put('cart_' . Auth::user()->id, $shoppingCart);

            } else {
                Session::put('cart_' . Auth::user()->id, [$id]);
            }
            return count(Session::get('cart_' . Auth::user()->id));
        }
    }

    private function addValueInSession($sessionName, $id)
    {
        if (Auth::check()) {
            $arr = [];
            if (Session::has('cart_' . Auth::user()->id)) {
                $arr = Session::get('cart_' . Auth::user()->id);
                if (is_array($arr) && ! in_array($id, $arr)) {
                    array_push($arr, $id);
                    Session::put('cart_' . Auth::user()->id, $arr);
                }
            } else {
                array_push($arr, $id);
                Session::put('cart_' . Auth::user()->id, $arr);
            }
        }
    }

    public function getAllOrders()
    {
        $data = Order::userId(Auth::user()->id)->get();
        return view('client.all_orders', compact('data'));
    }

    public function checkout(Request $request)
    {
        $keys = array_keys($request->all());
        $values = array_values($request->all());
        $productId = [];
        for ($i = 0, $len = count($keys); $i < $len; $i++) {
            array_push($productId, str_replace('product-', '', $keys[$i]));
        }

        $shoppingCart = array_combine($productId, $values);

        $calculate = 0;

        $products = Product::select('id', 'product_price', 'product_quantity')->whereIn('id', $productId)->get();

        $products = $products->toArray();

        for ($i = 0, $len = count($products); $i < $len; $i++) {
            $quantityFromCart = $shoppingCart[$products[$i]['id']];

            if ($quantityFromCart <= $products[$i]['product_quantity']) {
                $calculate += ($quantityFromCart * $products[$i]['product_price']);
            }
        }

        Order::create([
            'order_user_id' => Auth::user()->id,
            'order_total_amount' => $calculate,
            'order_address' => isset(Auth::user()->address) ? Auth::user()->address : '',
            'order_status' => 0
        ]);

        $lastOrder = Order::where('order_user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

        for ($i = 0, $len = count($productId); $i < $len; $i++) {
            OrderDetail::create([
                'order_id' => $lastOrder->id,
                'product_id' => $productId[$i],
                'product_quantity' => $shoppingCart[$productId[$i]]
            ]);
        }

        Session::put('cart_' . Auth::user()->id, []);
        return 'done';
    }
}
