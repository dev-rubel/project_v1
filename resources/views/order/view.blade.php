@extends('layouts.backend')

@section('title','Order View')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Order View</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{route('order.index')}}">Order</a></li>
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
      <div class="col-8 mx-auto">
        <div class="card">
            <div class="card-header"> Order<strong>#1</strong>
                <div style="float: right;"> <a class="btn btn-sm btn-info" href="#" onclick='printDiv();'><i class="fa fa-print mr-1"></i> Print</a>
                </div>
            </div>
            <div class="card-body" id="DivIdToPrint">
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <h6 class="mb-3">Order Information:</h6>
                        <div><strong>Id:</strong> {{$order->id}}</div>
                        <div><strong>Date:</strong> {{$order->dt_created}}</div>
                        <div><strong>Previous Print:</strong> {{$order->print_flag==0?'No':'Yes'}}</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                  <div class="col-lg-12 col-sm-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th class="right text-right">UNIT</th>
                                <th class="right text-right">COST</th>
                                <th class="right text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($order->orderDetails as $orderDetail)
                            <tr>
                                <td class="center">{{$orderDetail->product_id}}</td>
                                <td class="left">{{$orderDetail->product_name}}</td>
                                <td class="left"></td>
                                <td class="right text-right">{{$orderDetail->product_unit_amount}}</td>
                                <td class="right text-right">{{$orderDetail->product_unit_price}}</td>
                                <td class="right text-right">{{$orderDetail->product_unit_amount*$orderDetail->product_unit_price}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-sm-5 mx-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left"><strong>Subtotal</strong></td>
                                <td class="right text-right">{{$order->total_price}}</td>
                            </tr>
                            @php
                              $discount = 0;
                            @endphp
                            @if($order->discounted_percentage)
                              @php
                                $discount = ($order->discounted_percentage / 100) * $order->total_price;
                              @endphp
                              <tr>
                                  <td class="left"><strong>Discount ({{$order->discounted_percentage
                                  }}%)</strong></td>
                                  <td class="right text-right">{{$discount}}</td>
                              </tr>
                            @endif
                            <tr>
                                <td class="left"><strong>Total</strong></td>
                                <td class="right text-right"><strong>{{$order->total_price-$discount}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@push('script')
  <script>
    function printDiv() {
      var printContents = document.getElementById("DivIdToPrint").innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    (function() {
      var afterPrint = function() {
          $.ajax({
            url: '{{route('order.printStatus')}}',
            type: 'post',
            data: {order_id: '{{$order->id}}'},
            success: function(res) {
              console.log(res);
            }, error: function(err) {
              console.log(err);
            }
          })
      };
      if (window.matchMedia) {
          var mediaQueryList = window.matchMedia('print');
          mediaQueryList.addListener(function(mql) {
              if (!mql.matches) {
                  afterPrint();
              }
          });
      }
    }());
  </script>
@endpush
@endsection
