@extends('layouts.backend')

@section('title','User Create')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User Create</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{route('user.index')}}">User</a></li>
          <li class="breadcrumb-item active"><a href="#">Create</a></li>
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
      @if(!$errors->isEmpty())
        @foreach($errors->all() as $single_error)
          <div class="alert alert-danger alert-dismissible text-left">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $single_error }}
          </div>
        @endforeach
      @endif 
      <div class="card card-primary">
      <!-- form start -->
        <form role="form" action="{{route('user.store')}}" id="userForm" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="name">Name <strong class="required">*</strong></label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required>
            </div>
            <div class="form-group">
              <label for="user_type">User Type <strong class="required">*</strong></label>
              <select name="user_type" id="user_type" class="form-control" required>
                @if(auth()->user()->user_type!='staff')
                  <option value="admin">Admin</option>
                @endif
                <option value="staff">Staff</option>
              </select>
            </div>
            <div class="form-group">
              <label for="email">Email <strong class="required">*</strong></label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name="image" class="form-control" id="image">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="contact_number">Contact Number <strong class="required">*</strong></label>
              <input type="text" name="contact_number" class="form-control" id="contact_number" placeholder="Contact Number" required>
            </div>
            <div class="form-group">
              <label for="password">Password <strong class="required">*</strong></label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            </div>
            <div class="form-group">
              <label for="active_from">Active From </label>
              <div class="input-group date" id="active_from" data-target-input="nearest">
                  <input type="text" name="active_from" class="form-control datetimepicker-input" data-target="#active_from" placeholder="Active From (Date)" />
                  <div class="input-group-append" data-target="#active_from" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
            </div>
            <div class="form-group">
              <label for="active_to">Active To </label>
              <div class="input-group date" id="active_to" data-target-input="nearest">
                  <input type="text" name="active_to" class="form-control datetimepicker-input" data-target="#active_to" placeholder="Active To (Date)" />
                  <div class="input-group-append" data-target="#active_to" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    <!-- /.card -->
    </div>
  </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@push('script')
  <script>
    $('#active_from,#active_to').datetimepicker({
        format: 'YYYY-MM-DD'
    });
  </script>
@endpush
@endsection
