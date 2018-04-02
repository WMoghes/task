<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $guarded = [];

    public static function allCategories()
    {
        return Category::all()->pluck('category_name', 'id');
    }
}
