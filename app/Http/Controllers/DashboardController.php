<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Helpers\Custom;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->setting();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {            
            $all_customer   = Customer::count();
            $all_user       = User::count();
            $all_order      = Order::count();
            $staff_user     = User::where('user_type','staff')->count();
            return view('dashboard', compact('all_customer','all_user','all_order','staff_user'));
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }
}
