<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="{{route('dashboard')}}" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
      <span class="brand-text font-weight-light">{{$site_setting->site_name}}</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image" />
         </div>
         <div class="info">
            <a href="#" class="d-block">{{auth()->user()->name.' - '.ucwords(auth()->user()->user_type)}}</a>
         </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
               <a href="{{route('dashboard')}}" class="nav-link {{Custom::active_menu('dashboard')}}">
                  <i class="nav-icon fas fa-home"></i>
                  <p class="text">Dashboard</p>
               </a>
            </li>
            <li class="nav-item has-treeview {{Custom::active_menu(['user','user/create'],true)}}">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                     Users
                     <i class="right fas fa-angle-right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{route('user.create')}}" class="nav-link {{Custom::active_menu('user/create')}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create User</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('user.index')}}" class="nav-link {{Custom::active_menu('user')}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>User List</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview {{Custom::active_menu(['customer','customer/create'],true)}}">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-address-book"></i>
                  <p>
                     Customers
                     <i class="right fas fa-angle-right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{route('customer.create')}}" class="nav-link {{Custom::active_menu('customer/create')}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create Customer</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('customer.index')}}" class="nav-link {{Custom::active_menu('customer')}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Customer List</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview {{Custom::active_menu(['order'],true)}}">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-archive"></i>
                  <p>
                     Orders
                     <i class="right fas fa-angle-right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{route('order.index')}}" class="nav-link {{Custom::active_menu('order')}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Order List</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview {{Custom::active_menu(['setting'],true)}}">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                     Settings
                     <i class="right fas fa-angle-right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{route('setting.index')}}" class="nav-link {{Custom::active_menu('setting')}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>General Settings</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item">
               <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="nav-icon far fa-circle text-danger"></i>
                  <p class="text">Log Out</p>
               </a>
            </li>
            <!-- logout form start -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
             <!-- logout form end -->
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>
