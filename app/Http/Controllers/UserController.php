<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            if(auth()->user()->user_type=='staff')
                return back()->with('message','warning|You are not allowed for this action!!'); 

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
            if(auth()->user()->user_type=='staff')
                return back()->with('message','warning|You are not allowed for this action!!'); 

            $data = $request->except('_token');
            $this->validate($request, [
                'name' => 'required',
                'user_type' => 'required',
                'email' => 'required|email|unique:user',
                'contact_number' => 'required',
                'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);
            // save image
            $image_name = '';
            if ($request->hasFile('image')) {
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
            $user = new User;
            $user->username = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->phone = $data['contact_number'];
            $user->image = $image_name;
            $user->is_deleted = 0;
            $user->user_type = $data['user_type'];
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
            if(auth()->user()->user_type=='staff')
                return back()->with('message','warning|You are not allowed for this action!!'); 

            $user = User::where('id',$id)->first();
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
            if(auth()->user()->user_type=='staff')
                return back()->with('message','warning|You are not allowed for this action!!'); 

            $data = $request->except('_token');
            $this->validate($request, [
                'name' => 'required',
                'user_type' => 'required',
                'contact_number' => 'required',
                'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

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
            if(auth()->user()->user_type=='staff')
                return back()->with('message','warning|You are not allowed for this action!!'); 

            User::where('id',$id)->update(['is_deleted'=>1]);
            return redirect('user')->with('message','success|Data Delete Successfully.');
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

}
