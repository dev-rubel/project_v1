@extends('layouts.backend')

@section('title','Customer Create')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Customer Create</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{route('customer.index')}}">Customer</a></li>
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
        @if($errors->has('title'))
          <div class="alert alert-danger alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('title') }}
          </div>
        @endif 
        <div class="card card-primary">
        <!-- form start -->
           <form role="form" action="{{route('customer.store')}}" id="customerForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="customer_name">Customer/Company Name <strong class="required">*</strong></label>
                <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Enter Customer Name" required>
              </div>
              <div class="form-group">
                <label for="registration_number">Customer/Company Registration Number</label>
                <input type="text" name="registration_number" class="form-control" id="registration_number" placeholder="Registration Number">
              </div>
              <div class="form-group">
                <label for="image">Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="image">
                    <label class="custom-file-label" for="image">Choose image</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Customer/Company Address <strong class="required">*</strong></label>
                <input type="text" name="address_state" class="form-control" id="address_state" placeholder="State" required>
                <input type="text" name="address_post_code" class="form-control" id="address_post_code" placeholder="Post Code" required>
              </div>
              <div class="form-group">
                <label for="contact_number">Customer/Company Contact Number <strong class="required">*</strong></label>
                <input type="text" name="contact_number" class="form-control" id="contact_number" placeholder="Contact Number" required>
              </div>
              <div class="form-group">
                <label for="email">Customer/Company Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Contact Number">
              </div>
              <div class="form-group">
                <label for="assigned_to">Assigned to</label>
                <select name="assigned_to" id="assigned_to" class="form-control">
                  <option value="">Select User</option>
                  @foreach($user_list as $user)
                    <option value="{{$user->id}}">{{$user->name.' - '.ucwords($user->user_type)}}</option>
                  @endforeach
                </select>
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
  <!-- jquery-validation -->
  <script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $.validator.setDefaults({
        submitHandler: function () {
          alert( "Form successful submitted!" );
        }
      });
      $('#quickForm').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 5
          },
          terms: {
            required: true
          },
        },
        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
          terms: "Please accept our terms"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>
@endpush
@endsection
