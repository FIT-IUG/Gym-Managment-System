<!DOCTYPE html>
<html lang="arb" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--  font-awesome/6.1.1/ css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!--  boxicons@2.1.2/css css-->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <!-- BS v 5.2  -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <!-- BS icons v 1.9.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dist/img/superGym.png') }}">
    {{--    <link rel="stylesheet" href="{{asset('assets/css/mystyle.css')}}"/> --}}
    <title>Super Gym | @yield('title')</title>
    @yield('styles')
    @section('styles')
        {{--    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}"> --}}
    </head>

    <body>
        <!-- main -->
        <nav class="navbar navbar-expand-lg @yield('nav_bg')">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/img/logo.svg') }}" class="w-75" alt="">
                </a>
                <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                        <li class="nav-item ms-5">
                            <a class="nav-link {{ Request::is('home') ? 'active' : '' }} text-white fs-5 px-0"
                                href="{{ route('home') }}">الرئيسية</a>
                        </li>
                        <li class="nav-item ms-5">
                            <a class="nav-link {{ Request::is('service') ? 'active' : '' }} text-white fs-5 px-0"
                                href="{{ route('service') }}">خدماتنا</a>
                        </li>
                        <li class="nav-item dropdown ms-5 {{ Request::is('time_of_work', 'pricing') ? 'active' : '' }}">
                            <a class="nav-link {{ Request::is('time_of_work', 'pricing') ? 'active' : '' }} text-white fs-5 px-0"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                عضوية
                            </a>
                            <ul class="dropdown-menu bg-secondary-op py-4">
                                <li>
                                    <a class="dropdown-item f12 text-white px-3 {{ Request::is('time_of_work') ? 'active' : '' }}"
                                        href="{{ route('time_of_work') }}">أوقات العمل</a>
                                </li>
                                <li class="bg-light opacity-25">
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item f12 text-white px-3 {{ Request::is('pricing') ? 'active' : '' }}"
                                        href="{{ route('pricing') }}">خطة التسعير</a></li>
                            </ul>
                        </li>

                        <li class="nav-item ms-5">
                            <a class="nav-link {{ Request::is('blog') ? 'active' : '' }} text-white fs-5 px-0"
                                href="{{ route('blog') }}">مدونة</a>
                        </li>
                        <!-- Add other navigation items here -->
                        <!-- ... -->
                        @if (auth()->check())
                            @role('client')
                                <li class="nav-item dropdown  list-unstyled d-none d-lg-block me-5">
                                    <a class="nav-link text-white fs-5 px-0 " href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ auth()->user()->name }}
                                        <img src="{{ asset('imgs/users/' . Auth::user()->profile_img) }}"
                                            class="user-image img-circle elevation-2" width="50px" height="50px"
                                            alt="" style="border-radius: 100%">
                                    </a>
                                    <ul class="dropdown-menu bg-secondary-op py-4  text-center">
                                        <li class="dropdown-item">
                                            <a class=" f12 text-white px-3 text-decoration-none"
                                                href="{{ route('profile') }}">معلومات شخصية</a>
                                        </li>
                                        <li class="bg-light opacity-25">
                                            <hr class="dropdown-divider">
                                        </li>
                                        {{--                            <li><a class="dropdown-item f12 text-white " href="Message.html">رسالتي </a></li> --}}
                                        <li><a class="dropdown-item f12 text-white " href="{{ route('clintCoach') }}">المدربين
                                            </a></li>
                                        <li class="bg-light opacity-25">
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item f12 text-white " href="{{ route('clintSession') }}">جدول
                                                التمرين
                                            </a>
                                        </li>
                                        <li class="bg-light opacity-25">
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item f12 text-white "
                                                href="{{ route('parchedPackage') }}">الخدمات المشتراة
                                            </a>
                                        </li>
                                        <li class="bg-light opacity-25">
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item f12 text-danger  " href="{{ route('auth.logout') }}"
                                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">تسجيل
                                                خروج </a>

                                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endrole
                            @role('admin')
                                <li class="nav-item ms-4">
                                    <a class="btn btn-primary fs-5 px-4 {{ Request::is('dashboard') ? 'active' : '' }}"
                                        href="{{ route('dashboard') }}">لوحة التحكم</a>
                                </li>
                            @endrole
                        @else
                            <!-- User is not authenticated -->
                            <li class="nav-item ms-4">
                                <a class="btn btn-primary fs-5 px-4 {{ Request::is('login') ? 'active' : '' }}"
                                    href="{{ route('signIn') }}">تسجيل الدخول</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-secondary fs-5 px-4 {{ Request::is('join-us') ? 'active' : '' }}"
                                    href="{{ route('signUp') }}">انضم
                                    إلينا</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>


        {{-- <nav class="navbar navbar-expand-lg @yield('nav_bg')"> --}}
        {{--    <div class="container "> --}}
        {{--        <a class="navbar-brand" href="#"> --}}
        {{--            <img src="{{asset('assets/img/logo.svg')}}" class="w-75" alt=""> --}}
        {{--        </a> --}}
        {{--        <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse" --}}
        {{--                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" --}}
        {{--                aria-expanded="false" aria-label="Toggle navigation"> --}}
        {{--            <span class="navbar-toggler-icon"></span> --}}
        {{--        </button> --}}
        {{--        <div class="collapse navbar-collapse " id="navbarSupportedContent"> --}}
        {{--            <ul class="navbar-nav me-auto mb-2 mb-lg-0 "> --}}
        {{--                <li class="nav-item ms-5 "> --}}
        {{--                    <a class="nav-link active text-white fs-5 px-0" aria-current="page" href="{{route('home')}}">الرئيسية</a> --}}
        {{--                </li> --}}
        {{--                <li class="nav-item ms-5 "> --}}
        {{--                    <a class="nav-link text-white fs-5 px-0" aria-current="page" --}}
        {{--                       href="{{route('service')}}">خدماتنا</a> --}}
        {{--                </li> --}}
        {{--                <li class="nav-item dropdown ms-5"> --}}
        {{--                    <a class="nav-link text-white fs-5 px-0 " href="#" role="button" data-bs-toggle="dropdown" --}}
        {{--                       aria-expanded="false"> --}}
        {{--                        عضوية --}}
        {{--                    </a> --}}
        {{--                    <ul class="dropdown-menu bg-secondary-op py-4"> --}}
        {{--                        <li><a class="dropdown-item f12 text-white px-3" href="times of work.html">أوقات العمل</a> --}}
        {{--                        </li> --}}
        {{--                        <li class="bg-light opacity-25"> --}}
        {{--                            <hr class="dropdown-divider"> --}}
        {{--                        </li> --}}
        {{--                        <li><a class="dropdown-item f12 text-white px-3" href="pricing.html">خطة التسعير</a></li> --}}
        {{--                    </ul> --}}
        {{--                </li> --}}
        {{--                <li class="nav-item ms-5"> --}}
        {{--                    <a class="nav-link text-white fs-5 px-0 " aria-current="page" href="Blog.html">مدونة</a> --}}
        {{--                </li> --}}
        {{--                <li class=" nav-item ms-4 "> --}}
        {{--                    <a class=" btn btn-primary  fs-5  px-4" aria-current="page" href="log in.html">تسجيل الدخول</a> --}}
        {{--                </li> --}}
        {{--                <li class=" nav-item"> --}}
        {{--                    <a class=" btn btn-secondary  fs-5  px-4" aria-current="page" href="join us.html">انضم إلينا</a> --}}
        {{--                </li> --}}
        {{--            </ul> --}}
        {{--        </div> --}}
        {{--    </div> --}}
        {{-- </nav> --}}
        <!-- navbar -->
        {{-- @yield('main') --}}
        @yield('closeMain')

        @yield('main-content')

        <!-- Start Footer -->
        <footer class="bg-secondary " id="tempaltemo_footer">
            <div class="container py-5">
                <div class="row  d-flex justify-content-between">
                    <div class="col-md-2 pt-5">
                        <h4 class=" text-warning pb-4 ">يستكشف</h4>
                        <ul class="list-unstyled  fs-25  pe-0">
                            <li class="pb-2 "><a class="text-decoration-none text-white " href="#">الرئيسية</a>
                            </li>
                            <li class="pb-2"><a class="text-decoration-none text-white " href="#">الخدمات</a>
                            </li>
                            <li class="pb-2"><a class="text-decoration-none text-white " href="#">العضوية</a>
                            </li>
                            <li class="pb-2"><a class="text-decoration-none text-white " href="#">مدونة</a></li>
                        </ul>
                    </div>

                    <div class="col-md-2 pt-5 ">
                        <h4 class=" text-warning pb-4 ">خدمات</h4>
                        <ul class="list-unstyled  pe-0  fs-25">
                            <li class="pb-2"><a class="text-decoration-none text-white " href="#">لياقة بدنية</a>
                            </li>
                            <li class="pb-2"><a class="text-decoration-none text-white " href="#">كمال اجسام</a>
                            </li>
                            <li class="pb-2"><a class="text-decoration-none text-white " href="#">علاج طبيعي</a>
                            </li>
                            <li class="pb-2"><a class="text-decoration-none text-white " href="#">ساونا و
                                    بخار</a></li>
                            <li class="pb-2"><a class="text-decoration-none text-white " href="#">تدليك</a></li>
                        </ul>
                    </div>

                    <div class="col-md-2 pt-5 ">
                        <h4 class=" text-warning pb-4  ">Contact Infortion</h4>
                        <ul class="list-unstyled text-white  pe-0 ">
                            <li class="pb-2"><a class="text-decoration-none text-white fw-bold " href="#">للأعمال
                                    والذكور:</a></li>
                            <li class="pb-2"><img src="{{ asset('assets/img/footer/1.svg') }}" alt=""><a
                                    class="text-decoration-none text-white fs-25 pe-2" href="#">2847484-08</a></li>
                            <li class="pb-2"><img src="{{ asset('assets/img/footer/2.svg') }}" alt=""><a
                                    class="text-decoration-none text-white fs-25 pe-1 " href="#"> 059-5160200</a>
                            </li>
                            <li class="pb-2"><img src="{{ asset('assets/img/footer/2.svg') }}" alt=""><a
                                    class="text-decoration-none text-white fs-25 pe-1 " href="#"> 059-9627171</a>
                            </li>
                            <li class="pb-2 pt-3"><a class="text-decoration-none text-white fw-bold "
                                    href="#">للإناث:</a>
                            </li>
                            <li class="pb-2"><img src="{{ asset('assets/img/footer/1.svg') }}" alt=""><a
                                    class="text-decoration-none text-white fs-25 pe-1" href="#"> 059-7665870</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 pt-5  p-0">
                        <img src="{{ asset('assets/img/footer/QR.svg') }}" class="pe-5 me-4 mb-4" alt="">
                        <div>
                            <label class="text-white pb-2 pe-1" for="subscribeEmail">نرجو أن تتلقى آخر أخبارنا.</label>
                            <div class="input-group  bg-primary p-2    rounded-2">
                                <img src="{{ asset('assets/img/footer/3.svg') }}" alt="">
                                <input type="text" class="form-control bg-transparent border-0" id="subscribeEmail"
                                    placeholder="email@gmail.com">
                                <div class="input-group-text btn-primary text-light rounded-4">شترك</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="w-100 bg-warning py-3">
                <div class="container">
                    <div class="row pt-2">
                        <div class="col-9 ">
                            <p class="text-dark fw-bold ">
                                حقوق النشر &copy;بواسطة سوبر جيم جميع الحقوق محفوظة
                            </p>
                        </div>
                        <div class="col-auto me-auto ">
                            <ul class="list-inline text-left footer-icons ">
                                <li class="list-inline-item  text-center ">
                                    <a class=" " target="_blank" href="https://www.whatsapp.com/"><img
                                            src="{{ asset('assets/img/footer/4.svg') }}" class=" w-75"
                                            alt=""></a>
                                </li>
                                <li class="list-inline-item  text-center ">
                                    <a class=" " target="_blank" href="http://facebook.com/"><img
                                            src="{{ asset('assets/img/footer/5.svg') }}" class=" w-75"
                                            alt=""></a>
                                </li>
                                <li class="list-inline-item  text-center ">
                                    <a class=" " target="_blank" href="https://www.instagram.com/"><img
                                            src="{{ asset('assets/img/footer/6.svg') }}" class=" w-75"
                                            alt=""></a>
                                </li>
                                <li class="list-inline-item  text-center ">
                                    <a class="  " target="_blank" href=""><img
                                            src="{{ asset('assets/img/footer/7.svg') }}" class=" w-75"
                                            alt=""></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </footer>
        <!-- End Footer -->

        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/script.js') }}"></script>
        @yield('script')
    </body>

    </html>
