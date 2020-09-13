@extends('layouts.backend')

@section('title','User View')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User View ({{$user->name}})</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{route('user.index')}}">User</a></li>
          <li class="breadcrumb-item active"><a href="#">View</a></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
          <form role="form" id="userForm">
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name <strong class="required">*</strong></label>
                <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}" placeholder="Enter name" readonly>
              </div>
              <div class="form-group">
                <label for="user_type">User Type <strong class="required">*</strong></label>
                <select name="user_type" id="user_type" class="form-control" disabled>
                  <option value="admin" {{$user->user_type=='admin'?'selected':''}}>Admin</option>
                  <option value="staff" {{$user->user_type=='staff'?'selected':''}}>Staff</option>
                </select>
              </div>
              <div class="form-group">
                <label for="email">Email <strong class="required">*</strong></label>
                <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}" placeholder="Email" readonly>
              </div>
              <div class="form-group">
                <label for="image">Image</label>
                <div class="input-group">
                  <div class="custom-file mt-4 mb-4">
                    @php
                      $file_path = public_path().'/images/user/'.$user->image;
                      if(!is_file($file_path)){
                          $file_path = URL::to('/').'/images/default.png';
                      } else {                        
                        $file_path = URL::to('/').'/images/user/'.$user->image;
                      }
                    @endphp
                    <img src="{{$file_path}}" alt="" class="img-responsive" width="100px" height="100px">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="contact_number">Contact Number <strong class="required">*</strong></label>
                <input type="text" name="contact_number" class="form-control" value="{{$user->phone}}" id="contact_number" placeholder="Contact Number" readonly>
              </div>
              <div class="form-group">
                <label for="active_from">Active From </label>
                <input type="text" name="active_from" class="form-control" value="{{$user->active_from}}" id="active_from" placeholder="Active From (Date)" readonly>
              </div>
              <div class="form-group">
                <label for="active_to">Active To </label>
                <input type="text" name="active_to" class="form-control" value="{{$user->active_to}}" id="active_to" placeholder="Active To (Date)" readonly>
              </div>
            </div>
            <!-- /.card-body -->
          </form>
        </div>
      <!-- /.card -->
      </div>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
