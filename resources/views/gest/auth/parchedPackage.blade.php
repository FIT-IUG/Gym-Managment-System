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
                        <li class="breadcrumb-item active me-3" aria-current="page">الخدمات المشتراة</li>
                    </ol>
                </nav>
                <h2 class="text-white mt-5 pt-3 mb-4">الخدمات المشتراة</h2>
                <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 pb-5 mb-5">
                    <div class="col col-lg-12 px-5 pt-5 pt-lg-0 pe-0">
                        <div class="accordion bg-primary-op shadow rounded-4 py-3  " id="accordionExample">
                            @foreach ($boughtPackageCollection as $index => $package)
                                <div class="accordion-item bg-transparent text-white border-0">
                                    <h2 class="accordion-header px-3 border-0" id="heading{{ $index + 1 }}">
                                        <button class="accordion-button bg-transparent text-white fw-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index + 1 }}"
                                            aria-expanded="true" aria-controls="collapse{{ $index + 1 }}">
                                            {{ $package->package ? $package->package->name : 'not found' }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index + 1 }}" class="accordion-collapse collapse show"
                                        aria-labelledby="heading{{ $index + 1 }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="d-flex justify-center align-items-baseline">
                                                <h3 class="card-title mt-5">الخدمة :</h3>
                                                <pre>   </pre>
                                                <p class="card-text text-white opacity-75 mt-4 fs-25">
                                                    {{ $package->package ? $package->package->name : 'not found' }}</p>
                                            </div>
                                            <p class="card-text text-white opacity-75 mt-4 fs-25">السعر :
                                                {{ $package->price }}</p>
                                            <p class="card-text text-white opacity-75 mt-4 fs-25">الايام المتبقية لانتهاء
                                                الإشتراك :
                                                {{ $package->remaining_sessions }}</p>
                                            <p class="card-text text-white opacity-75 mt-4 fs-25">تاريخ الشراء :
                                                {{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    @endsection
@endrole

@section('scripts')
@endsection
