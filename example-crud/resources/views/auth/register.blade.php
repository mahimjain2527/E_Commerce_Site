@extends('layouts.app')
<head>

    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.css.map') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.css') }}">

    


    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

</head>
@section('content')
  <body class="">
    <main class="main-content  mt-0">
      <section>
        <div class="page-header min-vh-100">
          <div class="container">
            <div class="row">
              <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
                </div>
              </div>
              <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                <div class="card card-plain" style="border: none">
                  <div class="card-header">
                    <h4 class="font-weight-bolder">Register</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="regform">
                        @csrf

                        <!-- Your registration form fields go here -->
                        <!-- Name -->
                        <div class="input-group input-group-outline mb-3">
                            <label for="name" class="form-label"></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="input-group input-group-outline mb-3">
                            <label for="email" class="form-label"></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="input-group input-group-outline mb-3">
                            <label for="password" class="form-label"></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="input-group input-group-outline mb-3">
                            <label for="password-confirm" class="form-label"></label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>

                        <!-- Role Dropdown -->
                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                            <div class="col-md-6">
                                <select id="role" name="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <!-- Country Dropdown -->
                         <div class="input-group input-group-outline mb-3">
                            <label for="country" class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <select id="country" name="country" class="form-control">
                                    <option value="" selected disabled>Select Country</option>
                                </select>
                            </div>
                        </div>

                        <!-- State Dropdown -->
                        <div class="input-group input-group-outline mb-3">
                            <label for="state" class="col-md-4 col-form-label text-md-end">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select id="state" name="state" class="form-control">
                                    <option value="" selected disabled>Select State</option>
                                </select>
                            </div>
                        </div>

                        <!-- City Dropdown -->
                        <div class="input-group input-group-outline mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <select id="city" name="city" class="form-control">
                                    <option value="" selected disabled>Select City</option>
                                </select>
                            </div>
                        </div>

                        
                        <!-- Register Button -->
                        <div class="input-group input-group-outline mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                  </div>
                  <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-2 text-sm mx-auto">
                      Already have an account?
                      <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Log in</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script> 
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script> 
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script> 
    <script src="{{ asset('assets/js//material-dashboard.min.js?v=3.1.0') }}"></script> 
    

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Populate countries dropdown
            $.ajax({
                url: '/get-countries',
                method: 'get',
                success: function(response) {
                    var countryDropdown = $('#country');
                    countryDropdown.empty();
                    countryDropdown.append('<option value="" selected disabled>Select Country</option>');
                    $.each(response, function(id, name) {
                        countryDropdown.append('<option value="' + id + '">' + name + '</option>');
                    });
    
                    // Set up change event for countries dropdown
                    countryDropdown.change(function() {
                        var countryId = $(this).val();
                        if (countryId) {
                            // Fetch and populate states dropdown
                            $.ajax({
                                url: '/get-states/' + countryId,
                                method: 'get',
                                success: function(response) {
                                    var stateDropdown = $('#state');
                                    stateDropdown.empty();
                                    stateDropdown.append('<option value="" selected disabled>Select State</option>');
                                    $.each(response, function(id, name) {
                                        stateDropdown.append('<option value="' + id + '">' + name + '</option>');
                                    });
                                }
                            });
                        }
                    });
    
                    // Set up change event for states dropdown
                    $('#state').change(function() {
                        var stateId = $(this).val();
                        if (stateId) {
                            // Fetch and populate cities dropdown
                            $.ajax({
                                url: '/get-cities/' + stateId,
                                method: 'get',
                                success: function(response) {
                                    var cityDropdown = $('#city');
                                    cityDropdown.empty();
                                    cityDropdown.append('<option value="" selected disabled>Select City</option>');
                                    $.each(response, function(id, name) {
                                        cityDropdown.append('<option value="' + id + '">' + name + '</option>');
                                    });
                                }
                            });
                        }
                    });
                }
            });
        });
    </script>   
</body>
@endsection