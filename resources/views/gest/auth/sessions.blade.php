@extends('gest.parent')
@section('title', 'User Profile')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/Membership.css') }}" />
@endsection
@section('nav_bg', 'bg-secondary')
@section('closeMain')

@stop
@role('client')
    @section('main-content')
        <!-- Workout schedule  -->
        <section class="WorkoutSchedule bg-primary">
            <div class="container pt-5">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><a href="{{ route('home') }}"
                                class="text-white text-decoration-none">الرئيسية</a></li>
                        <li class="breadcrumb-item active me-3" aria-current="page">جدول التمرين</li>
                    </ol>
                </nav>
                <h2 class="text-white mt-5 pt-3 mb-4">جدول التمرين</h2>
                <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 pb-5 mb-5">
                    <div class="col col-lg-12 px-5 pt-5 pt-lg-0 pe-0">
                        <div class="accordion bg-primary-op shadow rounded-4 py-3  " id="accordionExample">
                            @foreach ($sessions as $index => $session)
                                <div class="accordion-item bg-transparent text-white border-0">
                                    <h2 class="accordion-header px-3 border-0" id="heading{{ $index + 1 }}">
                                        <button class="accordion-button bg-transparent text-white fw-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index + 1 }}"
                                            aria-expanded="false" aria-controls="collapse{{ $index + 1 }}">
                                            {{ $session->day }} : {{ $session->name }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index + 1 }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $index + 1 }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="card-body d-flex justify-between align-items-center">
                                                <h3 class="card-title mt-5">المدرب</h3>
                                                @foreach ($session->coaches as $coach)
                                                    {{-- <li>{{ $coach->name }}</li> --}}
                                                    <div class="col mb-5 d-flex justify-content-around">
                                                        <div class="card bg-primary-op rounded-5 shadow d-flex justify-between align-items-center py-5"
                                                            style="height: 100%;">
                                                            <div class="bg-transparent border-0 text-white text-center"
                                                                style="width: 18rem;">
                                                                <img src="{{ $coach->profile_image ? asset('imgs/coaches/' . $coach->profile_image) : asset('imgs/users/client.png') }}"
                                                                    alt="Coach Image" class="card-img-top"
                                                                    style="border-radius: 50%; width: 50% ;height: 50%;">
                                                                <div class="card-body">
                                                                    <h3 class="card-title mt-5">المدرب <br>{{ $coach->name }}
                                                                    </h3>
                                                                    <p class="card-text text-white opacity-75 mt-4 fs-25">
                                                                        {{ $coach->description ? $coach->description : '-' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <p class="card-text text-white opacity-75 mt-4 fs-25">التمرين يبدأ:
                                                {{ date('Y-m-d h:i a', strtotime($session->started_at)) }}</p>
                                            <p class="card-text text-white opacity-75 mt-4 fs-25">التمرين ينتهي :
                                                {{ date('Y-m-d h:i a', strtotime($session->finished_at)) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- <div class="accordion-item bg-transparent text-white border-0">
                                <h2 class="accordion-header px-3 border-0" id="headingTwo">
                                    <button class="accordion-button collapsed bg-transparent text-white fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        اليوم الثاني: عضلات الظهر والبايسبس
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class=" bg-transparent text-white f12   ">
                                            <li class="">Barbell Bench Press: 3 sets of 8-10 reps </li>
                                            <li class="">Incline Dumbbell Press: 3 sets of 10-12 reps </li>
                                            <li class="">Dumbbell Flyes: 3 sets of 12-15 reps</li>
                                            <li class="">Tricep Dips: 3 sets of 10-12 reps </li>
                                            <li class="">Tricep Pushdowns: 3 sets of 12-15 reps </li>
                                            <li class="">Overhead Dumbbell Extensions: 3 sets of 10-12 reps </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item bg-transparent text-white border-0">
                                <h2 class="accordion-header px-3 border-0" id="headingThree">
                                    <button class="accordion-button collapsed bg-transparent text-white fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        اليوم الثالث: الساقين والكتفين
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class=" bg-transparent text-white f12   ">
                                            <li class="">Barbell Bench Press: 3 sets of 8-10 reps </li>
                                            <li class="">Incline Dumbbell Press: 3 sets of 10-12 reps </li>
                                            <li class="">Dumbbell Flyes: 3 sets of 12-15 reps</li>
                                            <li class="">Tricep Dips: 3 sets of 10-12 reps </li>
                                            <li class="">Tricep Pushdowns: 3 sets of 12-15 reps </li>
                                            <li class="">Overhead Dumbbell Extensions: 3 sets of 10-12 reps </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item bg-transparent text-white border-0">
                                <h2 class="accordion-header px-3 border-0" id="headingThree">
                                    <button class="accordion-button collapsed bg-transparent text-white fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        اليوم الرابع: يوم راحة أو تمارين الكارديو الاختيارية
                                    </button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class=" bg-transparent text-white f12   ">
                                            <li class="">Barbell Bench Press: 3 sets of 8-10 reps </li>
                                            <li class="">Incline Dumbbell Press: 3 sets of 10-12 reps </li>
                                            <li class="">Dumbbell Flyes: 3 sets of 12-15 reps</li>
                                            <li class="">Tricep Dips: 3 sets of 10-12 reps </li>
                                            <li class="">Tricep Pushdowns: 3 sets of 12-15 reps </li>
                                            <li class="">Overhead Dumbbell Extensions: 3 sets of 10-12 reps </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item bg-transparent text-white border-0">
                                <h2 class="accordion-header px-3 border-0" id="headingThree">
                                    <button class="accordion-button collapsed bg-transparent text-white fw-bold"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapse5"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        اليوم الخامس: حلبة لكامل الجسم
                                    </button>
                                </h2>
                                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class=" bg-transparent text-white f12   ">
                                            <li class="">Barbell Bench Press: 3 sets of 8-10 reps </li>
                                            <li class="">Incline Dumbbell Press: 3 sets of 10-12 reps </li>
                                            <li class="">Dumbbell Flyes: 3 sets of 12-15 reps</li>
                                            <li class="">Tricep Dips: 3 sets of 10-12 reps </li>
                                            <li class="">Tricep Pushdowns: 3 sets of 12-15 reps </li>
                                            <li class="">Overhead Dumbbell Extensions: 3 sets of 10-12 reps </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item bg-transparent text-white border-0">
                                <h2 class="accordion-header px-3 border-0" id="headingThree">
                                    <button class="accordion-button collapsed bg-transparent text-white fw-bold"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapse6"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        اليوم السادس: القلب والأوعية الدموية
                                    </button>
                                </h2>
                                <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class=" bg-transparent text-white f12   ">
                                            <li class="">Barbell Bench Press: 3 sets of 8-10 reps </li>
                                            <li class="">Incline Dumbbell Press: 3 sets of 10-12 reps </li>
                                            <li class="">Dumbbell Flyes: 3 sets of 12-15 reps</li>
                                            <li class="">Tricep Dips: 3 sets of 10-12 reps </li>
                                            <li class="">Tricep Pushdowns: 3 sets of 12-15 reps </li>
                                            <li class="">Overhead Dumbbell Extensions: 3 sets of 10-12 reps </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item bg-transparent text-white border-0">
                                <h2 class="accordion-header px-3 border-0" id="headingThree">
                                    <button class="accordion-button collapsed bg-transparent text-white fw-bold"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapse7"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        اليوم السابع: يوم الراحة
                                    </button>
                                </h2>
                                <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class=" bg-transparent text-white f12   ">
                                            <li class="">Barbell Bench Press: 3 sets of 8-10 reps </li>
                                            <li class="">Incline Dumbbell Press: 3 sets of 10-12 reps </li>
                                            <li class="">Dumbbell Flyes: 3 sets of 12-15 reps</li>
                                            <li class="">Tricep Dips: 3 sets of 10-12 reps </li>
                                            <li class="">Tricep Pushdowns: 3 sets of 12-15 reps </li>
                                            <li class="">Overhead Dumbbell Extensions: 3 sets of 10-12 reps </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    {{-- <div
                        class="col  col-lg-4   bg-primary-op rounded-5 shadow d-flex justify-content-start align-items-center flex-column py-5 mt-5 mt-lg-0  ">
                        <section id="progressSection" class="progressSection ">
                            <div class="container">
                                <div class="circular-parenr ">
                                    <div class="circular-progress circularPprogress01">
                                        <h1 class="progress-value progressValue01  f50">0%</h1>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <h1 class="text-white mt-5">الهدف</h1>
                    </div> --}}
                </div>
            </div>
            </div>
        </section>
    @endsection
@endrole

@section('scripts')
@endsection
