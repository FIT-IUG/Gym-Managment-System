@extends('gest.parent')
@section('title', 'User Profile')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/Membership.css') }}"/>
@endsection
@section('nav_bg', 'bg-secondary')
@section('closeMain')

@stop
@role('client')
@section('main-content')
    <!-- My Coach -->
    <section class="My Coach  bg-primary">
        <div class="container pt-5">

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="{{ route('home') }}"
                                                    class="text-white text-decoration-none">الرئيسية</a>
                    </li>
                    <li class="breadcrumb-item active me-3" aria-current="page">مدربي</li>
                </ol>
            </nav>
            {{-- <div class="row row-cols-1  row-cols-md-1 row-cols-lg-2   pb-5 mb-5">
                @foreach ($coaches as $coach)
                    <div class="col col-lg-8 ">
                        <h2 class="text-white mb-4 mt-5 mb-5 me-2 ">تجربة مدربي</h2>
                        <div
                            class="col  col-lg-4 bg-primary-op rounded-5 shadow d-flex justify-content-center py-5 mt-5 mt-lg-0  ">
                            <div class=" bg-transparent   border-0 text-white text-center" style="width: 18rem;">
                                <img src="{{ asset('imgs/coaches/' . $coach->profile_image) }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h3 class="card-title mt-5">Coach <br>
                                        {{ $coach->name }}</h3>
                                    <p class="card-text text-white opacity-75 mt-4 fs-25">
                                        {{ $coach->description ? $coach->description : '-' }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 pb-5 mb-5">
                <h2 class="text-white mb-4 mt-5 mb-5 me-2 ">المدربين</h2>
                @foreach ($coaches as $coach)
                    <div class="col mb-5">
                        <div
                            class="card bg-primary-op rounded-5 shadow d-flex justify-content-center align-items-center py-5"
                            style="height: 100%;">
                            <div class="bg-transparent border-0 text-white text-center" style="width: 18rem;">
                                <img
                                    src="{{ $coach->profile_image ? asset('imgs/coaches/' . $coach->profile_image) : asset('imgs/users/client.png') }}"
                                    alt="Coach Image" class="card-img-top" style="border-radius: 50%">
                                <div class="card-body">
                                    <h3 class="card-title mt-5">المدرب <br>{{ $coach->name }}</h3>
                                    <p class="card-text text-white opacity-75 mt-4 fs-25">
                                        {{ $coach->description ? $coach->description : '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
@endrole

@section('scripts')
@endsection
