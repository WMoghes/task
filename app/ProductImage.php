<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'product_images';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Product')->select([
            'product_name', 'product_price'
        ]);
    }
}
