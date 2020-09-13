@extends('layouts.app') @section('content')

<div class="login-logo">
   <a href="#"><b>{{ __('Login') }}</b></a>
</div>
<!-- /.login-logo -->
<div class="card">
   <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('login') }}" method="post">
         @csrf
         <div class="input-group mb-3">
            <input id="email" type="email" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username" autofocus />
            @error('username')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="input-group-append">
               <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
               </div>
            </div>
         </div>
         <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="current-password" />
            @error('password')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="input-group-append">
               <div class="input-group-text">
                  <span class="fas fa-lock"></span>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-8">
               <div class="icheck-primary">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label for="remember">
                     {{ __('Remember Me') }}
                  </label>
               </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
               <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
            </div>
            <!-- /.col -->
         </div>
      </form>
      <!-- /.social-auth-links -->
   </div>
   <!-- /.login-card-body -->
</div>

@endsection
