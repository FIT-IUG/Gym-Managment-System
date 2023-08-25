<!doctype html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield("meta")
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <!-- <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('dist/img/superGym.png')}}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">


    <style>
        body {
            background-image: url("{{ asset('dist/img/bg.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: white;
        }

        table.dataTable tbody td {
            position: initial;
            vertical-align: middle;
        }

        table.dataTable tbody tr {
            background: rgb(52, 58, 64, 0);
        }
    </style>

    @yield("style")
    <script nonce="2aa84745-1cac-4d38-821f-5aae87ac1574">
        (function (w, d) {
            !function (a, e, t, r, z) {
                a.zarazData = a.zarazData || {}, a.zarazData.executed = [], a.zarazData.tracks = [], a.zaraz = {
                    deferred: []
                };
                var s = e.getElementsByTagName("title")[0];
                s && (a.zarazData.t = e.getElementsByTagName("title")[0].text), a.zarazData.w = a.screen.width, a
                    .zarazData.h = a.screen.height, a.zarazData.j = a.innerHeight, a.zarazData.e = a.innerWidth, a
                    .zarazData.l = a.location.href, a.zarazData.r = e.referrer, a.zarazData.k = a.screen.colorDepth, a
                    .zarazData.n = e.characterSet, a.zarazData.o = (new Date).getTimezoneOffset(), a.dataLayer = a
                    .dataLayer || [], a.zaraz.track = (e, t) => {
                    for (key in a.zarazData.tracks.push(e), t) a.zarazData["z_" + key] = t[key]
                }, a.zaraz._preSet = [], a.zaraz.set = (e, t, r) => {
                    a.zarazData["z_" + e] = t, a.zaraz._preSet.push([e, t, r])
                }, a.dataLayer.push({
                    "zaraz.start": (new Date).getTime()
                }), a.addEventListener("DOMContentLoaded", (() => {
                    var t = e.getElementsByTagName(r)[0],
                        z = e.createElement(r);
                    z.defer = !0, z.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(
                        a.zarazData))), t.parentNode.insertBefore(z, t)
                }))
            }(w, d, 0, "script");
        })(window, document);
    </script>
</head>


<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('dist/img/superGym.png') }}" alt="AdminLTELogo" height="150"
             width="150">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('dashboard') }}" class="nav-link">الرئيسية</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link text-warning" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{--                    {{ __('Logout') }}--}}
                    تسجيل الخروج
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                   aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('dist/img/superGym.png') }}" alt="superGym Logo" class="brand-image img-circle">
            <span class="brand-text">نادي سوبر جيم</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @role('admin')
                    <img src="{{ asset('imgs/users/' . Auth::user()->profile_img) }}" class="img-circle elevation-2"
                         alt="User Image">
                    @endrole
                    {{--                    @role('coach')--}}
                    {{--                    <img src="{{ asset('imgs/coaches/' . auth('coach')->user()->profile_image) }}"--}}
                    {{--                         class="img-circle elevation-2"--}}
                    {{--                         alt="Coach Image">--}}
                    {{--                    @endrole--}}
                    @auth('coach')
                        <img src="{{ asset('imgs/coaches/' . auth('coach')->user()->profile_image) }}"
                             class="img-circle elevation-2"
                             style="height: 50px; width: 50px"
                             alt="Coach Image">
                    @endauth
                </div>
                <div class="info">
                    @role('admin|client')
                    <a href="#" class="d-block font-weight-bold">{{ auth()->user()->name }}</a>
                    @endrole
                    @auth('coach')
                        <a href="#" class="d-block font-weight-bold">{{ auth('coach')->user()->name }}</a>
                    @endauth
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                           aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- <li class="nav-item /*menu-open"> -->

                    @hasanyrole('admin')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-running"></i>
                            <p>
                                المستخدمين
                            </p>
                        </a>
                    </li>
                    @endhasanyrole
                    @auth('coach')
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-running"></i>
                                <p>
                                    المستخدمين
                                </p>
                            </a>
                        </li>
                    @endauth

                    @hasanyrole('admin')
                    <li class="nav-item">
                        <a href="{{ route('blogs.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-blog"></i>
                            <p>
                                المدونات
                            </p>
                        </a>
                    </li>
                    @endhasanyrole

                    <li class="nav-header">PACKAGES</li>

                    @hasanyrole('admin|client')
                    <li class="nav-item">
                        <a href="{{ route('trainingPackages.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                الخدمات
                            </p>
                        </a>
                    </li>
                    @endhasanyrole
                    <li class="nav-item">
                        <a href="{{ route('sessions.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt "></i>
                            <p>
                                الحصص التدريبية
                            </p>
                        </a>
                    </li>

                    @hasanyrole('admin')
                    <li class="nav-item">
                        <a href="{{ route('coaches.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-bolt"></i>
                            <p>
                                المدربين
                            </p>
                        </a>
                    </li>
                    @endhasanyrole

                    @hasanyrole('admin|client')
                    <li class="nav-item">
                        <a href="{{ route('attendance.index') }}" class="nav-link">
                            <i class="nav-icon far fa-clipboard"></i>
                            <p>
                                الحضور
                            </p>
                        </a>
                    </li>
                    @endhasanyrole

                    @hasanyrole('admin|client')
                    <li class="nav-item">
                        <a href="{{ route('buyPackage.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-money-check"></i>
                            <p>
                                الخدمات المباعة
                            </p>
                        </a>
                    </li>
                    @endhasanyrole

                    @hasanyrole('admin')
                    <li class="nav-item mb-3">
                        <a href="{{ route('revenue.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                الدخل
                            </p>
                        </a>
                    </li>
                    @endhasanyrole
                    <!-- ---------------------------------------- -->

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Main Content -->
    <div id="bg" class="content-wrapper py-3">
        @yield('content')
    </div>

    <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>

</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<!-- jQuery Mapael -->
<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>

<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>


<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/axios.js') }}"></script>
@stack('scripts')

@yield("plugins")
@yield("script")
</body>

</html>
