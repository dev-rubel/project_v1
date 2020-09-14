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
                <div class="row">
                  <div class="col-sm-12 text-center">
                    @php
                      $file_path = public_path().'/images/hb.png';
                      if(!is_file($file_path)){
                          $file_path = URL::to('/').'/images/default.png';
                      } else {                        
                        $file_path = URL::to('/').'/images/hb.png';
                      }
                    @endphp
                    <img src="{{$file_path}}" alt="" width="60px" height="40px" class="mb-2">
                    <h2 class="ml-3" style="display: inline-block;">福 美 贸 易 公 司</h2>
                    <h2>HOCK BEE TRADING</h2>
                    <h5>No 28 & 29, LORONG HARUAN 5/1, OAKLAND COMMERCIAL SQUARE, 70300 SEREMBAN. N.S.D.K.</h3>
                    <h6>TEL : 606 - 601 7540,  FAX : 606 - 601 0450</h4>
                    <h6>(GST Reg No : 000249987072)</h4>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <p for="">MS:</p>
                    <hr class="pb-3">
                    <hr>
                    <p for="">A/C NO : 2010 - </p>
                    <hr class="pb-3">
                    <p for="">GST No :  </p>
                  </div>
                  <div class="col-sm-6">
                    <p>TAX INV NO:</p>
                    <p>DATE:</p>
                    <p class="pb-4">SALEMAN:</p>
                    <hr class="pb-3">
                    <p class="text-right">ctn</p>
                    <hr>
                    <p>SSM No :</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="table-responsive-sm">
                      <div class="col-lg-12 col-sm-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">NO</th>
                                    <th>Item Name</th>
                                    <th>PARTICULAR</th>
                                    <th class="right text-right">Quantity</th>
                                    <th class="right text-right">U.Price</th>
                                    <th class="right text-right">Amount</th>
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
                              <tr>
                                <td colspan="5" class="text-right text-bold">Total</td>
                                <td class="text-right">{{$order->total_price}}</td>
                              </tr>
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <br>
                <div class="row">
                  <div class="col-sm-4 text-center">
                    <hr>
                    <p>Prepared By</p>     
                  </div>
                  <div class="col-sm-4 text-center">
                    <hr>
                    <p>Check By</p>
                  </div>
                  <div class="col-sm-4 text-center">
                    <hr>
                    <p>Customer Chop & Sign</p>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-12">
                    <p class="text-bold">Remarks</p>
                    <hr class="pb-3">
                    <hr class="pb-3">
                    <hr class="pb-3">
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
