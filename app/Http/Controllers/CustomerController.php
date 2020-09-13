<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->setting();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $customer_list = Customer::where('is_deleted',0)->get();
            return view('customer.index', compact('customer_list'));
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            if(auth()->user()->user_type=='staff')
                return back()->with('message','warning|You are not allowed for this action!!'); 

            $user_list = User::where('is_deleted',0)->get();
            return view('customer.create', compact('user_list'));
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if(auth()->user()->user_type=='staff')
                return back()->with('message','warning|You are not allowed for this action!!'); 

            $data = $request->except('_token');
            $this->validate($request, [
                'customer_name' => 'required',
                'address_state' => 'required',
                'address_post_code' => 'required',
                'contact_number' => 'required'
            ]);
            // save image
            $image_name = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/customer');
                $image->move($destinationPath, $image_name);
            }

            // save customer data
            $customer = new Customer;
            $customer->company_name = $data['customer_name'];
            $customer->company_address = $data['address_state'].'|'.$data['address_post_code'];
            $customer->company_reg_no = $data['registration_number'];
            $customer->company_contact_no = $data['contact_number'];
            $customer->company_email = $data['email'];
            $customer->image = $image_name;
            $customer->is_deleted = 0;
            if($data['assigned_to']) {                
                $customer->assigned_to = $data['assigned_to'];
            }
            $customer->save();
            // redirect customer list
            return redirect('customer')->with('message','success|Data Insert successfully');  
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        try {
            $user_list = User::where('is_deleted',0)->get();
            return view('customer.view', compact('customer','user_list'));
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        try {
            if(auth()->user()->user_type=='staff')
                return back()->with('message','warning|You are not allowed for this action!!'); 

            $user_list = User::where('is_deleted',0)->get();
            return view('customer.edit', compact('customer', 'user_list'));
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        try {
            if(auth()->user()->user_type=='staff')
                return back()->with('message','warning|You are not allowed for this action!!'); 

            $data = $request->except('_token');
            $this->validate($request, [
                'customer_name' => 'required',
                'address_state' => 'required',
                'address_post_code' => 'required',
                'contact_number' => 'required'
            ]);
            // save image
            $image_name = $customer->image;
            if ($request->hasFile('image')) {
                // remove previous
                $file_path = public_path('/images/customer/'.$customer->image);
                if(is_file($file_path)){
                    unlink($file_path);
                }
                $image = $request->file('image');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/customer');
                $image->move($destinationPath, $image_name);
            }

            // save customer data
            $customer->company_name = $data['customer_name'];
            $customer->company_address = $data['address_state'].'|'.$data['address_post_code'];
            $customer->company_reg_no = $data['registration_number'];
            $customer->company_contact_no = $data['contact_number'];
            $customer->company_email = $data['email'];
            $customer->image = $image_name;
            $customer->is_deleted = 0;
            if($data['assigned_to']) {
                $customer->assigned_to = $data['assigned_to'];
            }
            $customer->save();
            // redirect customer list
            return redirect('customer')->with('message','success|Data Update successfully'); 
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            if(auth()->user()->user_type=='staff')
                return back()->with('message','warning|You are not allowed for this action!!'); 

            $customer->is_deleted = 1;
            $customer->save();
            return redirect('customer')->with('message','success|Data Delete Successfully.');   
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

}
