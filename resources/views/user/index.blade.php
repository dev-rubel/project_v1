@extends('layouts.backend')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<style>
  .user-view{
    cursor: pointer;
  }
</style>
@endpush

@section('title','User List')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User List</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="#">User</a></li>
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
            <table id="user_list" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>User Type</th>
                <th>Email</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($user_list as $user)
                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{ucfirst($user->user_type)}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{date('Y-m-d',strtotime($user->dt_created))}}</td>
                  <td>
                    <a href="{{route('user.show',$user->id)}}" class="btn btn-sm btn-primary user-view" data-id="1"><i class="fa fa-eye"></i></a>
                    <a href="{{route('user.edit',$user->id)}}" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                    @if(auth()->user()->id != $user->id)
                    <a href="#" class="btn btn-sm btn-danger destroy" data-id="{{$user->id}}"><i class="fa fa-trash"></i></a>
                    @endif
                    <!-- destroy form start -->
                    <form id="destroy-form-{{$user->id}}" action="{{ route('user.destroy',$user->id) }}" method="POST" style="display: none;">
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
    var userid = $(this).data('id');
    var r = confirm("Are you sure to delete this user?");
    if (r == true) {
      document.getElementById('destroy-form-'+userid).submit();
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
    $("#user_list").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
@endpush
@endsection
