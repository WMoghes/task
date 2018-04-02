<?php

namespace App\Http\Controllers;

use App\Traits\LoginTrait;
use Illuminate\Http\Request;

class ApiLoginController extends Controller
{
    use LoginTrait;

    /**
     * return token in success case (when user logged in)
     * @param Request $request
     * @return string <json>
     */
    public function postLogin(Request $request)
    {
        return $this->userLogin($request);
    }

    /**
     * return user data in success case
     * @param Request $request
     * @return string <json>
     */
    public function postRegister(Request $request)
    {
        return $this->userRegister($request);
    }
}
