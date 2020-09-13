<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'order_submitted_det';

    protected $fillable = [
        'order_submitted_id', 'dt_created', 'product_id','product_name','product_image','product_unit_amount','product_unit_price'
    ];

    public $timestamps = false;
}
