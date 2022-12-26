<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" ></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin_style.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  /> --}}
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- use toastr library -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- <div
                class="preloader flex-column justify-content-center align-items-center">
                <img
                    class="animation__shake"
                    src="{{asset('vendors/dist/img/asking-questions.webp')}}"
                    alt="QQClogo"
                    height="60"
                    width="60"
                />
            </div> -->

            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            data-widget="pushmenu"
                            href="#"
                            role="button"
                            ><i class="fas fa-bars"></i
                        ></a>
                    </li>
                    {{-- <li class="nav-item d-none d-sm-inline-block">
                        <a href="index3.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li> --}}
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        {{-- <a
                            class="nav-link"
                            data-widget="navbar-search"
                            href="#"
                            role="button"
                        >
                            <i class="fas fa-search"></i> --}}
                        {{-- <a style="text-decoration: none; color: blue; font-size:20px;" href="{{route('admin.register')}}"><i class="fa-solid fa-user-plus"></i></a> --}}
                                                
                        <a class="m-4" style="text-decoration: none; color: red; font-size:20px;" href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i></a>
                        
                        <div class="navbar-search-block">
                            <form class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input
                                        class="form-control form-control-navbar"
                                        type="search"
                                        placeholder="Search"
                                        aria-label="Search"
                                    />
                                    <div class="input-group-append">
                                        <button
                                            class="btn btn-navbar"
                                            type="submit"
                                        >
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button
                                            class="btn btn-navbar"
                                            type="button"
                                            data-widget="navbar-search"
                                        >
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                </ul>
            </nav>

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="#" class="brand-link">
                    <img
                        src="{{asset('img/asking-questions.webp')}}"
                        alt="Restaurant Logo"
                        class="brand-image img-circle elevation-3"
                        style="opacity: 0.8"
                    /> 
                    <span class="brand-text font-weight-light">Blah Restaurant</span>
                </a>

                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img
                                src="{{asset('img/user.png')}}"
                                class="img-circle elevation-2"
                                alt="User Image"
                            /> 
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Admin</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false">

                            <li class="nav-item menu-open">
                                <a href="{{route('admin.orderManagement.index')}}" class="nav-link {{ (request()->is('admin/orderManagement*')) ? 'active' : '' }}">
                                    <i class="fa-brands fa-waze"></i>
                                    <p>Orders</p>
                                </a>
                            </li> 
                                                        

                            <li class="nav-item menu-open">
                                <a href="{{route('admin.product.index')}}" class="nav-link {{ (request()->is('admin/product*')) ? 'active' : '' }}">
                                    <i class="fa-solid fa-bowl-food"></i></i>
                                    <p>Products</p>
                                </a>
                            </li>

                            <li class="nav-item menu-open">
                                <a href="{{route('admin.category.index')}}" class="nav-link {{ (request()->is('admin/category*')) ? 'active' : '' }}">
                                    <i class="fa-solid fa-list"></i>
                                    <p>Categories</p>
                                </a>
                            </li> 

                            <li class="nav-item menu-open">
                                <a href="{{route('admin.orderHistory.history')}}" class="nav-link {{ (request()->is('admin/orderHistory*')) ? 'active' : '' }}">
                                    <i class="fa-solid fa-table-cells"></i>
                                    <p>Order History</p>
                                </a>
                            </li> 
                        </ul>
                        
                    </nav>
                </div>
            </aside>

            @yield('content')


            <aside class="control-sidebar control-sidebar-dark"></aside>
        </div>
</body>


</html>
