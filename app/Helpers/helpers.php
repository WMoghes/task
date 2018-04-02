<?php
use Illuminate\Support\Facades\Crypt;

/**
 * return status name of order
 * @param $index
 * @return string
 */
function getNameOfOrderStatus($index)
{
    return getArrayOFOrderStatus()[$index];
}

/**
 * return array for status name of order
 * @return array
 */
function getArrayOFOrderStatus()
{
    return [
        'Pending', 'Accepted', 'Refused', 'Shipped'
    ];
}

/**
 * get array of clients status
 * @return array
 */
function getArrayOfClientStatus()
{
    return [
        'Activated', 'Suspended'
    ];
}

/**
 * return status name of client
 * @param $index
 * @return string
 */
function getNameOfClientStatus($index)
{
    return getArrayOfClientStatus()[$index];
}

/**
 * return array for published or unpublished
 * @return array
 */
function getArrayOfAdminVerify()
{
    return [
        'Unpublished', 'Published'
    ];
}

/**
 * return published or unpublished
 * @param $index
 * @return string
 */
function getNameOfAdminVerify($index)
{
    return getArrayOfAdminVerify()[$index];
}

function getProductPhotoSearch($product)
{
    if (isset($product->images[0])) {
        return url('assets/uploads/' . $product->images[0]->product_photo);
    } elseif (isset($product->product_photo)) {
        return url('assets/uploads/' . $product->product_photo);
    } elseif (is_object($product) && isset($product[0])) {
        return url('assets/uploads/' . $product[0]->product_photo);
    } else {
        return url('assets/uploads/default.png');
    }
}

/**
 * return name of product photo
 * @param $product
 * @return string
 */
function getProductPhoto($product)
{
    return (count($product->images) ?  $product->images[0]->product_photo : '');
}

/**
 * return secret string
 * @param $text
 * @return string
 */
function cryptText($text)
{
    return Crypt::encrypt($text);
}

/**
 * @param $text
 * @return string
 */
function decryptText($text)
{
    return Crypt::decrypt($text);
}

function getCountOfCart($sessionName)
{
    if (Session::has($sessionName)) {
        $arr = Session::get($sessionName);
        return count($arr);
    }
}

function checkItemExist($id, $sessionName)
{
    if (Session::has($sessionName)) {
        return in_array($id, Session::get($sessionName)) ? true : false;
    }
}

function getRegistrationData($fieldName, $registrationData)
{
    if (isset($registrationData)) {
        return $registrationData[$fieldName];
    }
}