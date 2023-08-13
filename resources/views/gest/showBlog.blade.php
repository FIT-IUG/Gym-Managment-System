@extends('gest.parent')
@section('title', 'Blog | {{ $blog->name }}')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/Service.css') }}" />
@endsection

@section('nav_bg', 'bg-secondary')

{{-- @section('main') --}}
{{--        @stop --}}
@section('closeMain')

@stop

@section('main-content')
    <!-- Fitness -->
    <section class="Fitness  bg-primary">
        <div class="container pt-5 pb-5">

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="{{ route('home') }}"
                            class="text-white text-decoration-none">الرئيسية</a></li>
                    <li class="breadcrumb-item "><a href="{{ route('blog') }}"
                            class="text-white text-decoration-none pe-2">المدونات</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
                </ol>
            </nav>
            <h1 class="text-warning mb-4 mt-5  ">{{ $blog->title }}</h1>
            <div class="row row-cols-1  row-cols-md-1 row-cols-lg-2   ">
                <div class="col  col-lg-4  ">
                    <div class="">
                        <img src="{{ asset('imgs/blogs/' . $blog->image) }}" class="w-100" style="border-radius: 5%"
                            alt="">
                    </div>
                </div>
                <div class="col col-lg-8 px-0 ">
                    <div class="pt-lg-0 pt-md-5 pt-sm-5 d-flex flex-column align-items-center justify-content-center">
                        <h3 class="text-muted fs-30 pe-5 mb-5 lh-lg">{{ $blog->subTitle }}</h3>
                        <p class="text-white fs-25 pe-5 lh-lg">{{ $blog->description }}</p>
                        {{-- <ul class=" bg-transparent text-white ull fs-25  pe-5 me-4 mt-5 mb-5 pb-5">
                            @foreach (explode("\n", $blog->description) as $desc)
                                <li class="mb-4">{{ $desc }}</li>
                            @endforeach
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
