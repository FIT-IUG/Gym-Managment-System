@extends('gest.parent')
@section('title', 'Home')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/mystyle.css') }}" />
@endsection

@section('nav_bg', 'bg-primary-op')

{{-- @section('main') --}}
{{--        @stop --}}
@section('closeMain')
    <main class="min-vh-100">
        <!-- main Text -->
        <div class="container min-vh-90  d-flex justify-content-start align-items-start pt-5">
            <div class="row pt-5 mt-5  ">
                <div class="col pt-5">
                    <h1 class="text-white f50 ">أفضل نادي رياضي في قطاع غزة
                        <br> <span class="text-warning">للرجال والنساء.</span>
                    </h1>
                    <p class="btn btn-primary fs-5 fw-bold px-5 py-3 rounded-4 mt-5">عرض المعرض</p>
                </div>
            </div>
        </div>
    </main>
@stop

@section('main-content')
    <!-- About us -->
    <section class="about bg-primary min-vh-100 pt-3">
        <div class="container py-0">
            <div class="row min-vh-90 row-cols-1  row-cols-md-2 py-0  ">
                <div class="col pe-lg-5  pe-sm-0">
                    <div class="pt-5 mt-5  text-white ps-5">
                        <h1 class="mt-5">معلومات عنا</h1>
                        <p class="fs-4 mt-5 opacity-75 fw-light hjp ps-5 ">هذا النص هو مثال لنص يمكن أن يستبدل في
                            نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص
                            أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                            إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما
                            تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على
                            وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
                            ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد
                            النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه
                            التصميم فيظهر بشكل لا يليق.</p>
                        <img src="assets/img/index/about/2.svg" class="mt-5" alt="">
                    </div>
                    <div class="text-white f12 opacity-50 mt-3">
                        <p>غزة الصبرة شارع الثلاثينى بداية شارع المغربي عمارة سكيك</p>
                        <p>من الثامنة صباحا حتى الحادية عشر مساءا</p>
                        <p>8:00 ص - 11:00 م</p>
                    </div>
                </div>
                <div class="col   d-flex pt-5 mt-5  overflow-hidden  ">
                    <img src="assets/img/index/about/3.svg" class="  " alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- service -->
    <section class="service">
        <div class="min-vh-100 bg-primary-op">
            <div class="container text-white pt-5">
                <h1 class="pt-5 mb-5  text-center">خدمات</h1>
                <div class="px-5 pt-3 ">
                    <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2  ">
                        {{--                        <div --}}
                        {{--                            class="col  d-flex  d-flex justify-content-lg-end justify-content-sm-center pt-lg-0 pt-sm-3  px-0 "> --}}
                        {{--                            <a href="Fitness.html" class="text-decoration-none text-white upp"> --}}
                        {{--                                <div --}}
                        {{--                                    class="card h-100 bg1 rounded-5 d-flex  align-items-end flex-row overflow-hidden bg-transparent"> --}}
                        {{--                                    <div class=" pe-4  mb-4"> --}}
                        {{--                                        <h5 class="text-end">لياقة بدنية</h5> --}}
                        {{--                                        <p class="text-end f11 ps-4 opacity-75">تشير اللياقة إلى حالة من الرفاهية --}}
                        {{--                                            الجسدية والعقلية تتحقق ...</p> --}}
                        {{--                                    </div> --}}
                        {{--                                    <div class=" mb-5 pb-5 ms-4 ps-1 gvg "> --}}
                        {{--                                        <img src="assets/img/index/service/rr.svg" alt=""> --}}
                        {{--                                    </div> --}}
                        {{--                                </div> --}}
                        {{--                            </a> --}}
                        {{--                        </div> --}}
                        @foreach ($services as $service)
                            <div class="col   d-flex justify-content-center pt-lg-0 pt-sm-3 px-0 mb-3 ">
                                <a href="{{ route('show_service', ['id' => $service->id]) }}"
                                    class="text-decoration-none text-white upp">
                                    <div style="background-image: url({{ url('imgs/gym/' . $service->image) }})"
                                        class="card h-100 bg2 rounded-5 d-flex  align-items-end flex-row overflow-hidden bg-transparent">
                                        <div class=" pe-4  mb-4">
                                            <h5 class="text-end">{{ $service->name }}</h5>
                                            <p class="text-end f11 ps-4 opacity-75">{{ $service->description }}</p>
                                        </div>
                                        <div class=" mb-5 pb-5 ms-4 ps-1 gvg ">
                                            <img src="" alt="">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        {{--                        <div --}}
                        {{--                            class="col   d-flex justify-content-lg-start justify-content-sm-center pt-lg-0 pt-sm-3  px-0 "> --}}
                        {{--                            <a href="Natural therapy.html" class="text-decoration-none text-white upp"> --}}
                        {{--                                <div --}}
                        {{--                                    class="card h-100 bg3 rounded-5 d-flex  align-items-end flex-row overflow-hidden bg-transparent"> --}}
                        {{--                                    <div class=" pe-4  mb-4"> --}}
                        {{--                                        <h5 class="text-end">العلاج الطبيعي</h5> --}}
                        {{--                                        <p class="text-end f11 ps-4 opacity-75">يشمل العلاج الطبيعي مجموعة من طرق --}}
                        {{--                                            العلاج البديلة التي تستخدم ...</p> --}}
                        {{--                                    </div> --}}
                        {{--                                    <div class=" mb-5 pb-5 ms-4 ps-1 gvg "> --}}
                        {{--                                        <img src="assets/img/index/service/rr.svg" alt=""> --}}
                        {{--                                    </div> --}}
                        {{--                                </div> --}}
                        {{--                            </a> --}}
                        {{--                        </div> --}}
                    </div>
                </div>
                {{--                <div class="px-5 pt-5  "> --}}
                {{--                    <div class="row row-cols-1 row-cols-lg-3  row-cols-md-2  d-flex justify-content-center "> --}}
                {{--                        <div class="col   d-flex justify-content-center pt-lg-0 pt-sm-3 px-0 "> --}}
                {{--                            <a href="Sauna & Steam.html" class="text-decoration-none text-white upp"> --}}
                {{--                                <div --}}
                {{--                                    class="card h-100 bg4 rounded-5 d-flex  align-items-end flex-row overflow-hidden bg-transparent"> --}}
                {{--                                    <div class=" pe-4  mb-4"> --}}
                {{--                                        <h5 class="text-end">ساونا وبخار</h5> --}}
                {{--                                        <p class="text-end f11 ps-4 opacity-75">يتضمن العلاج بالساونا والبخار --}}
                {{--                                            استخدام الحرارة والرطوبة لتعزيز ...</p> --}}
                {{--                                    </div> --}}
                {{--                                    <div class=" mb-5 pb-5 ms-4 ps-1 gvg "> --}}
                {{--                                        <img src="assets/img/index/service/rr.svg" alt=""> --}}
                {{--                                    </div> --}}
                {{--                                </div> --}}
                {{--                            </a> --}}
                {{--                        </div> --}}
                {{--                        <div --}}
                {{--                            class="col   d-flex justify-content-lg-start justify-content-sm-center pt-lg-0 pt-sm-3  px-0 "> --}}
                {{--                            <a href="Massage.html" class="text-decoration-none text-white upp"> --}}
                {{--                                <div --}}
                {{--                                    class="card h-100 bg5 rounded-5 d-flex  align-items-end flex-row overflow-hidden bg-transparent"> --}}
                {{--                                    <div class=" pe-4  mb-4"> --}}
                {{--                                        <h5 class="text-end">تدليك</h5> --}}
                {{--                                        <p class="text-end f11 ps-4 opacity-75">التدليك يتضمن التلاعب بالعضلات --}}
                {{--                                            لتعزيز الاسترخاء ...</p> --}}
                {{--                                    </div> --}}
                {{--                                    <div class=" mb-5 pb-5 ms-4 ps-1 gvg "> --}}
                {{--                                        <img src="assets/img/index/service/rr.svg" alt=""> --}}
                {{--                                    </div> --}}
                {{--                                </div> --}}
                {{--                            </a> --}}
                {{--                        </div> --}}
                {{--                    </div> --}}
                {{--                </div> --}}
            </div>
        </div>
    </section>
    <!-- Coach -->
    <section class="Coach bg-primary min-vh-100 pb-4">
        <div class="container text-white pt-5">
            <h1 class="pt-5  mb-5 pb-5   text-center ">المدربين</h1>
            <div>
                <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 g-4">
                    @foreach ($coaches as $coach)
                        <div class="col">
                            <div class="card h-100 bg-primary-op border-0 shadow overflow-hidden">
                                <div class="rounded-1 overflow-hidden">
                                    <img src="{{ url('imgs/coaches/' . $coach->profile_image) }}" class="card-img-top"
                                        alt="...">
                                </div>
                                <div class="card-body px-5 pt-4">
                                    <h5 class="card-title text-center">{{ $coach->name }}</h5>
                                    <p class="card-text text-center f11 opacity-75 mt-4 mb-4">{{ $coach->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{--                                        <div class="col"> --}}
                    {{--                                            <div class=" card h-100 bg-primary-op border-0 shadow overflow-hidden"> --}}
                    {{--                                                <div class=" rounded-1 overflow-hidden"> --}}
                    {{--                                                    <img src="assets/img/index/Coach/2.svg" class="card-img-top" alt="..."> --}}
                    {{--                                                </div> --}}
                    {{--                                                <div class="card-body px-5 pt-4"> --}}
                    {{--                                                    <h5 class="card-title text-center">محمود سونا </h5> --}}
                    {{--                                                    <p class="card-text text-warning text-center">35 سنة</p> --}}
                    {{--                                                    <p class="card-text text-center f11 opacity-75 mt-4 mb-4">يتضمن العلاج بالساونا --}}
                    {{--                                                        والبخار استخدام الحرارة والرطوبة لتعزيز ...</p> --}}
                    {{--                                                </div> --}}
                    {{--                                            </div> --}}
                    {{--                                        </div> --}}
                    {{--                                        <div class="col"> --}}
                    {{--                                            <div class=" card h-100 bg-primary-op border-0 shadow overflow-hidden"> --}}
                    {{--                                                <div class=" rounded-1 overflow-hidden"> --}}
                    {{--                                                    <img src="assets/img/index/Coach/3.svg" class="card-img-top" alt="..."> --}}
                    {{--                                                </div> --}}
                    {{--                                                <div class="card-body px-5 pt-4"> --}}
                    {{--                                                    <h5 class="card-title text-center">فضل رائد</h5> --}}
                    {{--                                                    <p class="card-text text-warning text-center">35 سنة</p> --}}
                    {{--                                                    <p class="card-text text-center f11 opacity-75 mt-4 mb-4">يتضمن العلاج بالساونا --}}
                    {{--                                                        والبخار استخدام الحرارة والرطوبة لتعزيز ...</p> --}}
                    {{--                                                </div> --}}
                    {{--                                            </div> --}}
                    {{--                                        </div> --}}
                    {{--                                        <div class="col"> --}}
                    {{--                                            <div class=" card h-100 bg-primary-op border-0 shadow overflow-hidden"> --}}
                    {{--                                                <div class=" rounded-1 overflow-hidden"> --}}
                    {{--                                                    <img src="assets/img/index/Coach/4.svg" class="card-img-top" alt="..."> --}}
                    {{--                                                </div> --}}
                    {{--                                                <div class="card-body px-5 pt-4"> --}}
                    {{--                                                    <h5 class="card-title text-center">نور وائل </h5> --}}
                    {{--                                                    <p class="card-text text-warning text-center">35 سنة</p> --}}
                    {{--                                                    <p class="card-text text-center f11 opacity-75 mt-4 mb-4">يتضمن العلاج بالساونا --}}
                    {{--                                                        والبخار استخدام الحرارة والرطوبة لتعزيز ...</p> --}}
                    {{--                                                </div> --}}
                    {{--                                            </div> --}}
                    {{--                                        </div> --}}

                </div>
            </div>
        </div>
    </section>
    <!-- Testmential -->
    <section class="Testmential">
        <div class="min-vh-100 bg-primary-op">
            <div class="container text-white pt-5">
                <h1 class="pt-5 mb-5  text-center">وصي</h1>
                {{--                <div id="carouselExampleDark" class="carousel  slide" data-bs-ride="carousel"> --}}
                {{--                    <div class="carousel-indicators "> --}}
                {{--                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" --}}
                {{--                                class="bg-secondary scd rounded-circle " aria-label="Slide 1"></button> --}}
                {{--                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" --}}
                {{--                                class="active bg-secondary  scd rounded-circle" aria-current="true" --}}
                {{--                                aria-label="Slide 2"></button> --}}
                {{--                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" --}}
                {{--                                class="bg-secondary scd rounded-circle " aria-label="Slide 3"></button> --}}
                {{--                    </div> --}}
                {{--                    <div class="carousel h-500 "> --}}
                {{--                        @foreach ($blogs as $blog) --}}
                {{--                            <div class="carousel-item active  h-300 " data-bs-interval="10000"> --}}
                {{--                                <div class="carousel-caption  d-md-block  "> --}}
                {{--                                    <h5 class="fs-3">{{$blog->description}}</h5> --}}
                {{--                                    <p class="pt-4 opacity-75">{{$blog->title}}</p> --}}
                {{--                                </div> --}}
                {{--                            </div> --}}
                {{--                        @endforeach --}}
                <div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($blogs as $index => $blog)
                            <button type="button" data-bs-target="#carouselExampleDark"
                                data-bs-slide-to="{{ $index }}"
                                class="{{ $index === 0 ? 'active' : '' }} bg-secondary scd rounded-circle"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel h-500">
                        @foreach ($blogs as $index => $blog)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }} h-300"
                                data-bs-interval="{{ $index === 0 ? '1000' : 'false' }}">
                                <div class="carousel-caption d-md-block">
                                    <h5 class="fs-3">{{ $blog->description }}</h5>
                                    <p class="pt-4 opacity-75">{{ $blog->title }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                        data-bs-slide="prev">
                        <span class="bg-primary rounded-circle" aria-hidden="true">
                            <i class='bx bx-chevron-left f50 text-warning'></i>
                        </span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                        data-bs-slide="next">
                        <span class="bg-primary rounded-circle" aria-hidden="true">
                            <i class='bx bx-chevron-right f50 text-warning'></i>
                        </span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                {{--                        <div class="carousel-item active h-300" data-bs-interval="2000"> --}}
                {{--                            <div class="carousel-caption  d-md-block  "> --}}
                {{--                                <h5 class="fs-3"> "توترت عضلاته وهو يرفع قضيب الحديد منتصرًا ، مظهراً القوة الغاشمة --}}
                {{--                                    والتصميم على رفع الأثقال"</h5> --}}
                {{--                                <p class="pt-4 opacity-75">عبد الصمد قرشي</p> --}}
                {{--                            </div> --}}
                {{--                        </div> --}}
                {{--                        <div class="carousel-item h-300"> --}}
                {{--                            <div class="carousel-caption  d-md-block  "> --}}
                {{--                                <h5 class="fs-3"> "توترت عضلاته وهو يرفع قضيب الحديد منتصرًا ، مظهراً القوة الغاشمة --}}
                {{--                                    والتصميم على رفع الأثقال"</h5> --}}
                {{--                                <p class="pt-4 opacity-75">عبد الصمد قرشي</p> --}}
                {{--                            </div> --}}
                {{--                        </div> --}}
            </div>
            {{--            <button class="carousel-control-prev " type="button" data-bs-target="#carouselExampleDark" --}}
            {{--                    data-bs-slide="prev"> --}}
            {{--        <span class="  bg-primary rounded-circle" aria-hidden="true"> --}}
            {{--          <i class='bx bx-chevron-left f50 text-warning'></i> --}}
            {{--        </span> --}}
            {{--                <span class="visually-hidden">Previous</span> --}}
            {{--            </button> --}}
            {{--            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" --}}
            {{--                    data-bs-slide="next"> --}}
            {{--        <span class="bg-primary rounded-circle" aria-hidden="true"> --}}
            {{--          <i class='bx bx-chevron-right f50 text-warning'></i> --}}
            {{--        </span> --}}
            {{--                <span class="visually-hidden">Next</span> --}}
            {{--            </button> --}}
        </div>
        </div>
        </div>
    </section>

@stop

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const carousel = new bootstrap.Carousel(document.getElementById('carouselExampleDark'), {
                interval: 1000 // Set the interval in milliseconds (e.g., 5000ms = 5 seconds)
            });
        });
    </script>

@endsection
