<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['admin']);
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
