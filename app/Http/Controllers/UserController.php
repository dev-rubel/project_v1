<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
            $user_list = User::where('is_deleted',0)->get();
            return view('user.index',compact('user_list'));
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
            return view('user.create');
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
            $data = $request->except('_token');
            if(auth()->user()->user_type=='staff' && $data['user_type']=='admin')
                return back()->with('message','warning|You are not allowed for this action!!'); 

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'user_type' => 'required',
                'email' => 'required|email',
                'contact_number' => 'required',
                'password' => 'nullable|min:6',
                'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);
            if ($validator->fails()) {
                return redirect('user/create')->withErrors($validator);
            }

            // if previous data exist then replace
            if(User::where('email', '=', $data['email'])->count() > 0) {
            	$user = User::where('email', '=', $data['email'])->first();
	            $image_name = $user->image;
            } else {
	            $user = new User;
	            $image_name = '';
            }

            // save image
            if ($request->hasFile('image')) {
            	if(!empty($image_name)) {
	            	// remove previous
	                $file_path = public_path('/images/user/'.$user->image);
	                if(is_file($file_path)){
	                    unlink($file_path);
	                }            		
            	}

                $image = $request->file('image');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/user');
                $image->move($destinationPath, $image_name);
            }
            // set default password
            if(!$data['password']) {
                $data['password'] = 'abc123';
            }
            // save user data
            $user->username = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->phone = $data['contact_number'];
            $user->image = $image_name;
            $user->is_deleted = 0;
            $user->user_type = $data['user_type'];
            $user->active_from = $data['active_from'];
            $user->active_to = $data['active_to'];
            $user->save();
            // redirect user list
            return redirect('user')->with('message','success|Data Insert successfully');
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {            
            $user = User::where('id',$id)->first();
            return view('user.view',compact('user'));
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = User::find($id);
            if(auth()->user()->user_type=='staff' && $user->user_type == 'admin')
                return back()->with('message','warning|You are not allowed for this action!!'); 

            return view('user.edit',compact('user'));
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token');
            if(auth()->user()->user_type=='staff' && $data['user_type']=='admin')
                return back()->with('message','warning|You are not allowed for this action!!'); 

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'user_type' => 'required',
                'contact_number' => 'required',
                'password' => 'nullable|min:6',
                'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);
            if ($validator->fails()) {
                return redirect('user/'.$id.'/edit')->withErrors($validator);
            }

            $user = User::find($id);
            // save image
            $image_name = $user->image;
            if ($request->hasFile('image')) {
                // remove previous
                $file_path = public_path('/images/user/'.$user->image);
                if(is_file($file_path)){
                    unlink($file_path);
                }
                $image = $request->file('image');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/user');
                $image->move($destinationPath, $image_name);
            }
            // if password input
            if($data['password']) {                
                $user->password = Hash::make($data['password']);
            }
            // update user data
            $user->username = $data['email'];
            $user->name = $data['name'];
            $user->phone = $data['contact_number'];
            $user->image = $image_name;
            $user->user_type = $data['user_type'];
            $user->active_from = $data['active_from'];
            $user->active_to = $data['active_to'];
            $user->save();
            // redirect user list
            return redirect('user')->with('message','success|Data Update successfully');
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if(auth()->user()->user_type=='staff' && $user->user_type == 'admin')
                return back()->with('message','warning|You are not allowed for this action!!'); 
            $user->is_deleted = 1;
            $user->save();
            return redirect('user')->with('message','success|Data Delete Successfully.');
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

}
