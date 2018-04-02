<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function images()
    {
        return $this->hasMany('App\ProductImage', 'product_id')->orderBy('created_at', 'desc');
    }

    public function orders()
    {
        return $this->hasMany('App\OrderDetail', 'product_id');
    }

    public function scopePublished($query)
    {
        return $query->where('products.product_admin_verify', 1);
    }

    public function scopeUnPublished($query)
    {
        return $query->where('products.product_admin_verify', 0);
    }

    public function scopeMaxPrice($query)
    {
        return $this->select('product_price')->max('product_price');
    }

    public function scopeMinPrice($query)
    {
        return $this->select('product_price')->min('product_price');
    }
}
