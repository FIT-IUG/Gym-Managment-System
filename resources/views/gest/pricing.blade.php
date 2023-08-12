@extends('gest.parent')
@section('title','Price Package')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/css/Membership.css')}}"/>
@endsection
@section('nav_bg','bg-secondary')
@section('closeMain')

@stop
@section('main-content')
    <!-- pricing -->
    <section class="pricing  bg-primary">
        <div class="container pt-5 pb-1">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="{{route('home')}}"
                                                    class="text-white text-decoration-none">الرئيسية</a></li>
                    <li class="breadcrumb-item active me-3" aria-current="page">التسعير</li>
                </ol>
            </nav>
            <h1 class="text-warning mb-4 mt-5  ">التسعير </h1>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3  pb-5">
                <div class="col ">
                    <div class="card h-100 text-muted  border-0 bggg  ">
                        <img src="assets/img/Membership/1.svg" class="card-img-top " alt="...">
                        <div class="card-body  pt-2  pb-4">
                            <h2 class="text-white  ">40
                                <span class="text-warning fs-25 fw-normal">/1 شهر</span>
                            </h2>
                            <div class="px-4">
                                <p class="text-center mt-5">6 أيام في الأسبوع</p>
                                <p class="text-center py-3   border-warning ">تخصيص مدرب مخصص</p>
                                <p class="text-center ">دفعات الصباح والمساء</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card h-100 text-muted bggg border-0   ">
                        <img src="assets/img/Membership/2.svg" class="card-img-top " alt="...">
                        <div class="card-body  pt-2  pb-4">
                            <h2 class="text-white  ">100
                                <span class="text-warning fs-25 fw-normal">/3 شهور</span>
                            </h2>
                            <div class="px-4">
                                <p class="text-center mt-5">6 أيام في الأسبوع</p>
                                <p class="text-center py-3   border-warning ">تخصيص مدرب مخصص</p>
                                <p class="text-center ">دفعات الصباح والمساء</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card h-100 text-muted bggg border-0   ">
                        <img src="assets/img/Membership/3.svg" class="card-img-top " alt="...">
                        <div class="card-body  pt-2  pb-4">
                            <h2 class="text-white  ">180
                                <span class="text-warning fs-25 fw-normal">/6 شهور</span>
                            </h2>
                            <div class="px-4">
                                <p class="text-center mt-5">6 أيام في الأسبوع</p>
                                <p class="text-center py-3   border-warning ">تخصيص مدرب مخصص</p>
                                <p class="text-center ">دفعات الصباح والمساء</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
