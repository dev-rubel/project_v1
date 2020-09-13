<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order_submitted';

    protected $fillable = [
        'user_id', 'dt_created', 'cust_id','discounted_percentage','total_price','print_flag'
    ];

    public function orderDetails()
    {
    	return $this->hasMany('App\OrderDetails','order_submitted_id','id');
    }

    public function orderUser()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function orderCustomer()
    {
    	return $this->belongsTo('App\Customer','cust_id','id');    	
    }

    public $timestamps = false;
}
