<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Order_{{$order->id}}</title>
        <meta charset="utf-8">
        <!-- Font Awesome -->
		<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Tempusdominus Bbootstrap 4 -->
		<link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
		<!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<style>
			table.table-bordered{
			    border:1px solid #000;
			  }
			table.table-bordered > thead > tr > th{
			    border:1px solid #000;
			}
			table.table-bordered > tbody > tr > td{
			    border:1px solid #000;
			}
			@media print{
		        .table thead tr th,.table tbody tr td{
		            border-color: #000 !important;
		            -webkit-print-color-adjust:exact ;
		        }
		    }
		    @font-face {
			    font-family: 'arial'; /*a name to be used later*/
			    src: url('{{asset('dist/arial.ttf')}}'); /*URL to font*/
			}
			body {
				font-family: 'arial';
			}
		</style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
    	<div class="wrapper">
			<div class="col-sm-10 mx-auto">
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
				<br>
				<div class="row">
				  <div class="col-sm-6 text-left">
				    <p for="">MS: {{$order->orderCustomer['company_name']}}</p>
				    <hr class="pb-3" style="border-color: #000;">
				    <hr class="pb-3" style="border-color: #000;">
				    <hr style="border-color: #000;">
				    <div class="form-group row">
						<p class="col-sm-2">A/C NO : 2010 - </p>
						<div class="col-sm-10">
						  <hr class="pb-3" style="border-color: #000;">
						</div>
					</div>
				    <p>GST No :  </p>
				  </div>
				  <div class="col-sm-6">
				  	<div class="offset-sm-4 col-sm-8">
					    <p>TAX INV NO</p>
						<div class="form-group row">
							<p class="col-sm-2">Date: </p>
							<div class="col-sm-10">
							  <input type="text" value="{{date('Y-m-d', strtotime($order->dt_created))}}" style="width: 100%; border: 1px solid #000; text-align: right;">
							</div>
						</div>
						<div class="form-group row">
							<p class="col-sm-4" >SALEMAN: </p>
							<div class="col-sm-8">
							  <input type="text" value="{{$order->orderUser['name']}}" style="width: 100%; border: 1px solid #000; text-align: right;">
							</div>
						</div>
					    <p class="text-right" style="border: 1px solid #000; padding-top: 38px;padding-right: 5px;">ctn</p>
				    </div>
				    <p>SSM No : {{$order->orderCustomer['company_reg_no']}}</p>
				  </div>
				</div>
				<div class="row">
				  <div class="col-sm-12">
				    <div class="table-responsive-sm">
				      <div class="col-lg-12 col-sm-12">
				        <table class="table table-bordered">
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
				    <hr style="border-color: #000;">
				    <p>Prepared By</p>     
				  </div>
				  <div class="col-sm-4 text-center">
				    <hr style="border-color: #000;">
				    <p>Check By</p>
				  </div>
				  <div class="col-sm-4 text-center">
				    <hr style="border-color: #000;">
				    <p>Customer Chop & Sign</p>
				  </div>
				</div>
				<br>
				<div class="row">
				  <div class="col-sm-12">
				    <p class="text-bold">Remarks</p>
				    <hr class="pb-3" style="border-color: #000;">
				    <hr class="pb-3" style="border-color: #000;">
				    <hr class="pb-3" style="border-color: #000;">
				  </div>
				</div>
			</div>
	    </div>   

	    <!-- jQuery -->
	<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script></script>
	<script>
		window.onload = function() { window.print(); setTimeout(window.close, 0);  }

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
	</body>
</html>