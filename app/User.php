<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permission()
    {
        return $this->belongsTo('App\Permission')->select([
            'permission_name'
        ]);
    }

    public function orders()
    {
        return $this->hasMany('App/Order', 'order_user_id');
    }

    public function scopeAllClients($query)
    {
        return $query->where('permission_id', 2);
    }
}
