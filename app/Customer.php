<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	public $with = ['order'];
    protected $table = 'cust';
    protected $fillable = [
        'company_name', 'company_address', 'company_reg_no','company_contact_no','image','dt_created','assigned_to','company_email', 'company_addressline1','company_addressline2'
    ];

    public function user()
    {
    	return $this->hasOne('App\User','id','assigned_to');
    }

    public function order()
    {
    	return $this->hasMany('App\Order','cust_id','id');
    }

    public $timestamps = false;
}
