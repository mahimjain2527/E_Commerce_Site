<head>

    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.css.map') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.css') }}">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" /> --}}

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
      <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
          <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
              
              <h3 class="font-weight-bolder mb-0">PRODUCT CITE</h3>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
              <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                  
                </div>
              </div>
              <ul class="navbar-nav  justify-content-end">


                @guest
                  @if (Route::has('login'))
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>
                  @endif

                  @if (Route::has('register'))
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                  @endif

                  @else
                    <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('orders.myorders') }}">
                          My Orders
                        </a>
                          <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                          </a>
                          <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            Profile
                          </a>
                          

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </div>
                    </li>
                @endguest

              </ul>
            </div>
          </div>
        </nav>
        
</body>
</html>