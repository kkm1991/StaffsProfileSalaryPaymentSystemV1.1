<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Example for linking the favicon -->
     <link rel="shortcut icon" type="x-icon" href="storage/logos/bsmlogo.png">
     <link rel="stylesheet" href=".\node_modules\@fortawesome\fontawesome-free\css\brands.css">
     <link rel="stylesheet" href=".\node_modules\@fortawesome\fontawesome-free\css\fontawesome.css">
     <link rel="stylesheet" href=".\node_modules\@fortawesome\fontawesome-free\css\solid.css">
     
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-success shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav  me-auto   ">
                        <li class="nav-item dropdown  ">
                            <a class="nav-link dropdown-toggle mt-1 border text-center rounded-pill text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              ဝန်ထမ်းရေးရာ
                            </a>
                            <ul class="dropdown-menu ps-1">
                              
                              <li><a class="dropdown-item ps-1" data-bs-toggle="modal" data-bs-target="#departmentModal"   ><img src="{{ asset('storage/logos/Add.png') }}" alt="Logo"width="25" height="25">  အလုပ်ဌာန  </a></li>
                              <li><a class="dropdown-item ps-1" data-bs-toggle="modal" data-bs-target="#positionModal"    ><img src="{{ asset('storage/logos/Add.png') }}" alt="Logo"width="25" height="25">  ရာထူး  </a></li>
                              <li><a class="dropdown-item ps-1" data-bs-toggle="modal"data-bs-target="#educationModal"    ><img src="{{ asset('storage/logos/Add.png') }}" alt="Logo"width="25" height="25">  ပညာအရည်အချင်း  </a></li>
                            </ul>
                          </li>
                          <li class="nav-item text-center p-1"><a href="{{url('/paymentlist')}}" class="nav-link  border rounded-pill text-white"  >လစာပေးရန်ဝန်ထမ်းစာရင်း</a></li>
                          <li class="nav-item text-center p-1"><a href="{{url('/salaries')}}" class="nav-link border rounded-pill text-white"  >   လစာ စာရင်း</a></li>
                          <li class="nav-item text-center p-1"><a href="{{url('/salaries/report')}}" class="nav-link border rounded-pill text-white"  >   လစာ စာရင်းအချုပ်</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <!-- ဌာနသစ်ထဲ့ရန် modal -->
        <div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="departmentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">ဌာနသစ်ထဲ့</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{url('/department/add')}}" method="POST">
                        @csrf
                        <!-- Form fields -->
                        <div class="form-group">
                            <label for="name">ဌာနအမည်</label><br>
                            <input type="text" class="form-control" id="depname" name="depname" required>
                        </div><br>
                        
                        <!-- Additional form fields... -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                   
                </div>
              </div>
            </div>
          </div>
          <!-- ရာထူးအမည်သစ်ထဲ့ရန် modal -->
        <div class="modal fade" id="positionModal" tabindex="-1" aria-labelledby="positionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">ရာထူးအမည်သစ်ထဲ့ရန်</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{url('/position/add')}}" method="POST">
                        @csrf
                        <!-- Form fields -->
                        <div class="form-group">
                            <label for="name">ရာထူးအမည်</label><br>
                            <input type="text" class="form-control" id="positionname" name="positionname" required>
                        </div><br>
                        
                        <!-- Additional form fields... -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                   
                </div>
              </div>
            </div>
          </div>

 <!-- ပညာအရည်အချင်းအမည်သစ်ထဲ့ရန် modal -->
 <div class="modal fade" id="educationModal" tabindex="-1" aria-labelledby="educationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ပညာအရည်အချင်း အမည်သစ်ထဲ့ရန်</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{url('/education/add')}}" method="POST">
                @csrf
                <!-- Form fields -->
                <div class="form-group">
                    <label for="name">ပညာအရည်အချင်းအမည်</label><br>
                    <input type="text" class="form-control" id="eduname" name="eduname" required>
                </div><br>
                
                <!-- Additional form fields... -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="modal-footer">
           
        </div>
      </div>
    </div>
  </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
