@extends('layouts.backend')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<style>
  .order-view{
    cursor: pointer;
  }
</style>
@endpush

@section('title','Order List')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Order List</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="#">Order</a></li>
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
        <div class="card">
          <div class="card-body">
            <table id="order_list" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Order Id</th>
                <th>Order Customer Name</th>
                <th>Order Created</th>
                <th>Order Staff Name</th>
                <th>Order Total Price</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($order_list as $order)
                  <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->orderCustomer['company_name']}}</td>
                    <td>{{date('Y-m-d', strtotime($order->dt_created))}}</td>
                    <td>{{$order->orderUser['name']}}</td>
                    <td>{{$order->total_price}}</td>
                    <td>
                      <a href="{{route('order.show',$order->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
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
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
    $("#order_list").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
@endpush
@endsection
