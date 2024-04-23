@extends('layouts.app')
{{-- @section('content') --}}
<head>

    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.css.map') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.css') }}">

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

</head>
<body class="bg-gray-200 " >
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100 py-0" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                  
                </div>
              </div>

              <div class="card-body">
                <form method="POST" action="{{ route('login') }}" class="text-start">
                    @csrf
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label"></label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label"></label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-check form-switch d-flex align-items-center mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                    </div>
                    <p class="mt-4 text-sm text-center">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Register</a>
                    </p>
                </form>
            </div>
            </div>
          </div>
        </div>
      </div>
     
    </div>
  </main> 
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script> 
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script> 
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script> 
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script> 
  
  
</body>

</html>
{{-- @endsection --}}