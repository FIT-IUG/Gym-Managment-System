@extends('gest.parent')
@section('title','Schedule Work')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/css/Membership.css')}}"/>
@endsection
@section('nav_bg','bg-secondary')
@section('closeMain')

@stop
@section('main-content')
    <!-- times of work -->
    <section class="times  bg-primary">
        <div class="container pt-5 pb-1">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="{{route('home')}}"
                                                    class="text-white text-decoration-none">الرئيسية</a></li>
                    <li class="breadcrumb-item active me-3" aria-current="page">أوقات العمل</li>
                </ol>
            </nav>
            <h1 class="text-warning mb-4 mt-5  ">أوقات العمل </h1>

            <div class="rounded-4 overflow-hidden mb-5">
                <!-- Saturday -->
                <div class="row  text-white text-center ">
                    <div
                        class="col col-3 bg-warning text-dark  d-flex justify-content-center  align-items-center boddrrs ps-sm-4 ps-lg-0 ps-4 ">
                        <h2 class="">السبت</h2>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr">
                        <h4 class="py-4 boddr bg-secondary-op">سيدات</h4>
                        <p class="fs-25 fw-light py-2  "> 8:00 – 2:00</p>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr">
                        <h4 class="py-4 boddr bg-secondary-op">رجال</h4>
                        <p class="fs-25 fw-light py-2  "> 2:00 – 11:00</p>
                    </div>
                </div>

                <!-- Sunday -->
                <div class="row  text-white text-center ">
                    <div
                        class="col col-3 bg-warning text-dark  d-flex justify-content-center  align-items-center boddrrs ps-sm-4 ps-lg-0 ps-4 ">
                        <h2 class="">الاحد</h2>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr">
                        <h4 class="py-4 boddr bg-secondary-op">رجال</h4>
                        <p class="fs-25 fw-light py-2  "> 8:00–11:45</p>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr">
                        <h4 class="py-4 boddr bg-secondary-op">سيدات</h4>
                        <p class="fs-25 fw-light py-2  "> 12:00–3:00 </p>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr ">
                        <h4 class="py-4 boddr bg-secondary-op">رجال</h4>
                        <p class="fs-25 fw-light py-2 pe-1 pe-sm-1 pe-lg-0"> 4:00–11:00 </p>
                    </div>
                </div>
                <!-- Monday -->
                <div class="row  text-white text-center ">
                    <div
                        class="col col-3 bg-warning text-dark  d-flex justify-content-center  align-items-center boddrrs ps-sm-4 ps-lg-0 ps-4 ">
                        <h2 class="">الاثنين</h2>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr">
                        <h4 class="py-4 boddr bg-secondary-op">سيدات</h4>
                        <p class="fs-25 fw-light py-2  "> 8:00 – 2:00</p>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr">
                        <h4 class="py-4 boddr bg-secondary-op">رجال</h4>
                        <p class="fs-25 fw-light py-2  "> 2:00 – 11:00</p>
                    </div>
                </div>

                <!-- Tuesday -->
                <div class="row  text-white text-center ">
                    <div
                        class="col col-3 bg-warning text-dark  d-flex justify-content-center  align-items-center boddrrs ps-sm-4 ps-lg-0 ps-4 ">
                        <h2 class="">الثلاثاء</h2>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr">
                        <h4 class="py-4 boddr bg-secondary-op">رجال</h4>
                        <p class="fs-25 fw-light py-2  "> 8:00–11:45</p>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr">
                        <h4 class="py-4 boddr bg-secondary-op">سيدات</h4>
                        <p class="fs-25 fw-light py-2  "> 12:00–3:00 </p>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr ">
                        <h4 class="py-4 boddr bg-secondary-op">رجال</h4>
                        <p class="fs-25 fw-light py-2 pe-1 pe-sm-1 pe-lg-0"> 4:00–11:00 </p>
                    </div>
                </div>
                <!-- Wednesday -->
                <div class="row  text-white text-center ">
                    <div
                        class="col col-3 bg-warning text-dark  d-flex justify-content-center  align-items-center boddrrs ps-sm-4 ps-lg-0 ps-4 ">
                        <h2 class="">الاربعاء</h2>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr">
                        <h4 class="py-4 boddr bg-secondary-op">سيدات</h4>
                        <p class="fs-25 fw-light py-2  "> 8:00 – 2:00</p>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr">
                        <h4 class="py-4 boddr bg-secondary-op">رجال</h4>
                        <p class="fs-25 fw-light py-2  "> 2:00 – 11:00</p>
                    </div>
                </div>

                <!-- Thursday -->
                <div class="row  text-white text-center  ">
                    <div
                        class="col col-3 bg-warning text-dark  d-flex justify-content-center  align-items-center boddrrs ps-sm-4 ps-lg-0 ps-4 ">
                        <h2 class="">الخميس</h2>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr">
                        <h4 class="py-4 boddr bg-secondary-op">رجال</h4>
                        <p class="fs-25 fw-light py-2  "> 8:00–11:45</p>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr">
                        <h4 class="py-4 boddr bg-secondary-op">سيدات</h4>
                        <p class="fs-25 fw-light py-2  "> 12:00–3:00 </p>
                    </div>
                    <div class="col  bg-primary-op px-0 boddrr ">
                        <h4 class="py-4 boddr bg-secondary-op">رجال</h4>
                        <p class="fs-25 fw-light py-2 pe-1 pe-sm-1 pe-lg-0"> 4:00–11:00 </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
