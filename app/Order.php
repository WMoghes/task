<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'order_user_id');
    }

    public function details()
    {
        return $this->hasMany('App\OrderDetail', 'order_id');
    }

    public function scopePending($query)
    {
        return $query->where('order_status', 0);
    }

    public function scopeAccepted($query)
    {
        return $query->where('order_status', 1);
    }

    public function scopeRefused($query)
    {
        return $query->where('order_status', 2);
    }

    public function scopeShipped($query)
    {
        return $query->where('order_status', 3);
    }

    public function scopeUserId($query, $userId)
    {
        return $query->where('order_user_id', $userId);
    }

}
