@extends('layouts.backend')

@section('title','Customer View')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{$customer->company_name}}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{route('customer.index')}}">Customer</a></li>
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
        <!-- form start -->
          <form role="form" id="customerForm">
            <div class="card-body">
              <div class="form-group">
                <label for="customer_name">Customer/Company Name</label>
                <input type="text" name="customer_name" class="form-control" value="{{$customer->company_name}}" id="customer_name" placeholder="Enter Customer Name" readonly>
              </div>
              <div class="form-group">
                <label for="registration_number">Customer/Company Registration Number</label>
                <input type="text" name="registration_number" class="form-control" value="{{$customer->company_contact_no}}" id="registration_number" placeholder="Registration Number" readonly>
              </div>
              <div class="form-group">
                <label for="image">Image</label>
                <div class="input-group">
                  <div class="custom-file mt-4 mb-4">
                    @php
                      $file_path = public_path().'/images/customer/'.$customer->image;
                      if(!is_file($file_path)){
                          $file_path = URL::to('/').'/images/default.png';
                      } else {                        
                        $file_path = URL::to('/').'/images/customer/'.$customer->image;
                      }
                    @endphp
                    <img src="{{$file_path}}" alt="" class="img-responsive" width="100px" height="100px">
                  </div>
                </div>
              </div>
              <div class="form-group">
                @php
                  list($state, $post_code) = array_pad(explode('|', $customer->company_address), 2, '');
                  $states = [
                    'JHR' => 'Johor',
                    'KDH' => 'Kedah',
                    'KTN' => 'Kelantan',
                    'MLK' => 'Melaka',
                    'NSN' => 'Negeri Sembilan',
                    'PHG' => 'Pahang',
                    'PRK' => 'Perak',
                    'PLS' => 'Perlis',
                    'PNG' => 'Pulau Pinang',
                    'SBH' => 'Sabah',
                    'SWK' => 'Sarawak',
                    'SGR' => 'Selangor',
                    'TRG' => 'Terengganu',
                    'KUL' => 'W.P. Kuala Lumpur',
                    'LBN' => 'W.P. Labuan',
                    'PJY' => 'W.P. Putrajaya',
                  ];
                @endphp
                <label>Customer/Company Address</label>
                <input type="text" name="address_line1" class="form-control" value="{{$customer->company_addressline1}}" id="address_line1" placeholder="Address Line 1" readonly>
                <input type="text" name="address_line2" class="form-control" value="{{$customer->company_addressline2}}" id="address_line2" placeholder="Address Line 2" readonly>
                <input type="text" name="address_state" class="form-control" value="{{$states[$state]}}" id="address_state" placeholder="State" readonly>
                <input type="text" name="address_post_code" class="form-control" value="{{$post_code}}" id="address_post_code" placeholder="Post Code" readonly>
              </div>
              <div class="form-group">
                <label for="contact_number">Customer/Company Contact Number</label>
                <input type="text" name="contact_number" class="form-control" value="{{$customer->company_contact_no}}" id="contact_number" placeholder="Contact Number" readonly>
              </div>
              <div class="form-group">
                <label for="contact_number">Customer/Company Email</label>
                <input type="email" name="contact_number" class="form-control" value="{{$customer->company_email}}" id="contact_number" placeholder="Email" readonly>
              </div>
              <div class="form-group">
                <label for="assigned_to">Assigned to</label>
                <select name="assigned_to" id="assigned_to" class="form-control" disabled>
                  <option value="">Select User</option>
                  @foreach($user_list as $user)
                    <option value="{{$user->id}}" {{$customer->assigned_to==$user->id?'selected':''}}>{{$user->name.' - '.ucwords($user->user_type)}}</option>
                  @endforeach
                </select>
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
