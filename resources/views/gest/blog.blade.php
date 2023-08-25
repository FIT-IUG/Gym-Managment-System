@extends('gest.parent')
@section('title', 'Blog')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/Blog.css') }}" />
@endsection
@section('nav_bg', 'bg-secondary')
@section('closeMain')

@stop
@section('main-content')
    <!-- Blog -->
    <section class="Blog  bg-primary">
        <div class="container pt-5 pb-5">

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="{{ route('home') }}"
                            class="text-white text-decoration-none">الرئيسية</a></li>
                    <li class="breadcrumb-item active me-3" aria-current="page">مدونة</li>
                </ol>
            </nav>
            <h1 class="text-warning mb-4 mt-5  ">مدونة وأخبار</h1>
            {{--            <div class="row  row-cols-lg-1 BlogNews rounded-3 d-flex justify-content-center"> --}}
            {{--                <div class="col px-5  w-75 colbloge d-flex justify-content-center  align-items-center"> --}}
            {{--                    <div class="px-lg-5 "> --}}
            {{--                        <h2 class="text-center ">"توترت عضلاته وهو يرفع قضيب الحديد منتصرًا ، مظهراً القوة الغاشمة --}}
            {{--                            والتصميم على رفع الأثقال"</h2> --}}
            {{--                    </div> --}}
            {{--                </div> --}}
            {{--            </div> --}}
            <div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($blogs as $index => $blog)
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $index }}"
                            class="{{ $index === 0 ? 'active' : '' }} bg-secondary scd rounded-circle"
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($blogs as $index => $blog)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row row-cols-lg-1 BlogNews rounded-3 d-flex justify-content-center">
                                <div class="col px-5 w-75 colbloge d-flex justify-content-center align-items-center">
                                    <div class="px-lg-5">
                                        <h2 class="text-center">{{ $blog->description }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-primary rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-primary rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </section>
    <section class="bg-primary pt-5 ">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3  pb-5">
                @foreach ($blogs as $blog)
                    <div class="col" style="padding-bottom: 30px">
                        <a href="{{ route('show_blog', ['id' => $blog->id]) }}" class="text-withe text-decoration-none">
                            <div class="card h-100 text-white bg-transparent border-0">
                                <img src="{{ asset('imgs/blogs/' . $blog->image) }}" class="card-img-top" alt="...">
                                <div
                                    class="card-img-overlay card-footer d-flex justify-content-start align-items-center pt-5   mt-5 ">
                                    <div
                                        class="bg-warning d-flex align-items-center align-content-center justify-content-center  rounded-5 mt-4  ">
                                        {{--                                    <img src="assets/img/Blog/aa.svg" class="  pe-2 py-2" alt=""> --}}
                                        <h5 class="card-title   ms-2 pe-4 mt-2 ms-4 text-dark ">{{ $blog->title }}</h5>
                                    </div>
                                </div>
                                <div class="card-body  ps-5 pe-0">
                                    <h5 class="card-title ">{{ $blog->subTitle }} </h5>
                                    <p class="card-text ps-5 fs-16 mt-3 text-muted">{{ $blog->description }}</p>
                                </div>
                                <div
                                    class="border border-white border-opacity-25 border-start-0 border-end-0 border-bottom-0 d-flex justify-content-between pt-2">
                                    <span>
                                        <img src="assets/img/Blog/calendar.svg" alt="">
                                        <small
                                            class="text-muted">{{ \Carbon\Carbon::parse($blog->created_at)->format('Y-m-d') }}</small>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
