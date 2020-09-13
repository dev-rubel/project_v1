@extends('layouts.backend')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<style>
  .customer-view{
    cursor: pointer;
  }
</style>
@endpush

@section('title','Customer List')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Customer List</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="#">Customer</a></li>
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
      <div class="col-12">
        <div class="card card-primary">
          <!-- /.card-header -->
          <div class="card-body">
            <table id="customer_list" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Customer Id</th>
                <th>Customer Name (Company Name)</th>
                <th>Registration Number</th>
                <th>Total Order</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($customer_list as $customer)
                <tr>
                  <td>{{$customer->id}}</td>
                  <td>{{$customer->company_name}}</td>
                  <td>{{$customer->company_reg_no}}</td>
                  <td>{{count($customer->order)}}</td>
                  <td>{{$customer->dt_created}}</td>
                  <td>
                    <a href="{{route('customer.show',$customer->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                    <a href="{{route('customer.edit',$customer->id)}}" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                    <a href="#" class="btn btn-sm btn-danger destroy" data-id="{{$customer->id}}"><i class="fa fa-trash"></i></a>
                    <!-- destroy form start -->
                    <form id="destroy-form-{{$customer->id}}" action="{{ route('customer.destroy',$customer->id) }}" method="POST" style="display: none;">
                         @csrf
                         {{ method_field('DELETE') }}
                     </form>
                     <!-- destroy form end -->
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
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
  // delete user
  $('.destroy').on('click', function() {
    var customerid = $(this).data('id');
    var r = confirm("Are You Sure!");
    if (r == true) {
      document.getElementById('destroy-form-'+customerid).submit();
    }
  });
</script>
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
    $("#customer_list").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
@endpush
@endsection
