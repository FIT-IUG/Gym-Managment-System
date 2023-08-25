@extends('gest.parent')
@section('title', 'Service')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/Service.css') }}" />
@endsection

@section('nav_bg', 'bg-secondary')

{{-- @section('main') --}}
{{--        @stop --}}
@section('closeMain')

@stop

@section('main-content')
    @foreach ($services as $key => $service)
        <section class="{{ $key % 2 === 0 ? 'Fitness' : 'Body' }} bg-primary pb-4">
            <div class="container pt-5">
                <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 mt-5 pt-3">
                    @if ($key % 2 === 0)
                        <div class="col px-0 ps-5">
                            <h2 class="text-warning mb-4">{{ $service->name }}</h2>
                            <p class="text-white fs-25 ps-5">{{ $service->description }}</p>
                            <a href="{{ route('show_service', ['id' => $service->id]) }}" class="text-decoration-none">
                                <p class="text-white fs-25 ps-5 text-end pe-0 fw-light">
                                    اقرأ المزيد عن الخدمة
                                    <img src="{{ asset('assets/img/Service/arrow.svg') }}" class="me-3 arrowsize"
                                        alt="">
                                </p>
                            </a>
                        </div>
                        <div class="col text-lg-end text-md-center px-0">
                            <img src="{{ asset('imgs/gym/' . $service->image) }}" class="img-fluid"
                                style="border-radius: 5%" alt="{{ $service->name }}">
                        </div>
                    @else
                        <div class="col text-lg-start text-md-center px-0">
                            <img src="{{ asset('imgs/gym/' . $service->image) }}" class="img-fluid"
                                style="border-radius: 5%" alt="{{ $service->name }}">
                        </div>
                        <div class="col ps-5 px-0">
                            <div class="ps-4">
                                <h2 class="text-warning mb-4 pe-5">{{ $service->name }}</h2>
                                <p class="text-white fs-25 pe-5 ps-5">{{ $service->description }}</p>
                                <a href="{{ route('show_service', ['id' => $service->id]) }}" class="text-decoration-none">
                                    <p class="text-white fs-25 ps-5 text-end pe-0 fw-light" style="margin-right: 8%">
                                        اقرأ المزيد عن الخدمة
                                        <img src="{{ asset('assets/img/Service/arrow.svg') }}" class="me-3 arrowsize"
                                            alt="">
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endforeach

    {{--    <!-- Fitness --> --}}
    {{--    <section class="Fitness  bg-primary"> --}}
    {{--        <div class="container pt-5"> --}}
    {{--            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb"> --}}
    {{--                <ol class="breadcrumb"> --}}
    {{--                    <li class="breadcrumb-item "><a href="index.html" --}}
    {{--                                                    class="text-white text-decoration-none">الرئيسية</a></li> --}}
    {{--                    <li class="breadcrumb-item active pe-4" aria-current="page">خدمات</li> --}}
    {{--                </ol> --}}
    {{--            </nav> --}}
    {{--            @foreach ($services as $service) --}}
    {{--                <div class="service-section row  row-cols-1  row-cols-md-1 row-cols-lg-2 mt-5 pt-3  "> --}}
    {{--                    <div class="col  px-0 ps-5"> --}}
    {{--                        <h2 class="text-warning mb-4 ">{{$service->name}}</h2> --}}
    {{--                        <p class="text-white fs-25 ps-5 ">{{$service->description}}</p> --}}
    {{--                        <a href="Fitness.html" class="text-decoration-none "> --}}
    {{--                            <p class="text-white fs-25 ps-5  text-end pe-0 fw-light"> --}}
    {{--                                اقرأ المزيد عن الخدمة --}}
    {{--                                <img src="{{asset('assets/img/Service/arrow.svg')}}" class="me-3  arrowsize  " alt=""> --}}
    {{--                            </p> --}}
    {{--                        </a> --}}
    {{--                    </div> --}}
    {{--                    <div class="col   text-lg-end text-md-center px-0"> --}}
    {{--                        <img src="{{asset('assets/img/Service/1.svg')}}" class="img-fluid" alt=""> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--            @endforeach --}}
    {{--        </div> --}}
    {{--    </section> --}}
    {{--    <!-- Body Building --> --}}
    {{--    <section class="Body   bg-primary"> --}}
    {{--        <div class="container pt-5"> --}}
    {{--            <div class="row row-cols-1  row-cols-md-1 row-cols-lg-2 mt-5  "> --}}
    {{--                <div class="col  px-0  "> --}}
    {{--                    <div class=" text-lg-start text-md-center"> --}}
    {{--                        <img src="{{asset('assets/img/Service/2.svg')}}" class="img-fluid" alt=""> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--                <div class="col  ps-5 px-0"> --}}
    {{--                    <div class=" ps-4"> --}}
    {{--                        <h2 class="text-warning mb-4 pe-5"> كمال اجسام</h2> --}}
    {{--                        <p class="text-white fs-25 pe-5">كمال الأجسام هو شكل متخصص من اللياقة البدنية يركز على بناء ونحت --}}
    {{--                            كتلة العضلات. يتضمن تدريبًا مكثفًا على المقاومة جنبًا إلى جنب مع نظام غذائي صارم ومنظم. يسعى --}}
    {{--                            لاعبو كمال الأجسام إلى تطوير لياقتهم البدنية إلى أقصى إمكاناتها ، مع التركيز على حجم العضلات --}}
    {{--                            والتماثل والتعريف. يتطلب هذا الانضباط الصعب الالتزام والتفاني والاتساق في كل من التدريب --}}
    {{--                            والتغذية.</p> --}}
    {{--                        <a href="body Building.html" class="text-decoration-none "> --}}
    {{--                            <p class="text-white fs-25 ps-5 pe-5 text-end pe-0 fw-light"> --}}
    {{--                                اقرأ المزيد عن الخدمة --}}
    {{--                                <img src="{{asset('assets/img/Service/arrow.svg')}}" class="me-3  arrowsize  " alt=""> --}}
    {{--                            </p> --}}
    {{--                        </a> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </section> --}}
    {{--    <!-- Natural Therapy --> --}}
    {{--    <section class="Natural   bg-primary"> --}}
    {{--        <div class="container pt-5"> --}}

    {{--            <div class="row  row-cols-1  row-cols-md-1 row-cols-lg-2 mt-5 pt-3  "> --}}
    {{--                <div class="col  px-0 ps-5"> --}}
    {{--                    <h2 class="text-warning mb-4 ">علاج طبيعي</h2> --}}
    {{--                    <p class="text-white fs-25 ps-5 ">العلاج الطبيعي ، الذي يشار إليه غالبًا باسم العلاج الطبيعي ، هو --}}
    {{--                        مهنة رعاية صحية متخصصة تركز على تحسين واستعادة الوظيفة البدنية والحركة. يعمل المعالجون --}}
    {{--                        الفيزيائيون بشكل وثيق مع الأفراد من جميع الأعمار الذين عانوا من إصابة أو مرض أو إعاقة ، بهدف --}}
    {{--                        تقليل الألم وتعزيز الحركة وتحسين نوعية الحياة بشكل عام. من خلال مزيج من الأساليب اليدوية --}}
    {{--                        والتمارين العلاجية</p> --}}
    {{--                    <a href="Natural therapy.html" class="text-decoration-none "> --}}
    {{--                        <p class="text-white fs-25 ps-5  text-end pe-0 fw-light"> --}}
    {{--                            اقرأ المزيد عن الخدمة --}}
    {{--                            <img src="{{asset('assets/img/Service/arrow.svg')}}" class="me-3  arrowsize  " alt=""> --}}
    {{--                        </p> --}}
    {{--                    </a> --}}
    {{--                </div> --}}
    {{--                <div class="col   text-lg-end text-md-center px-0"> --}}
    {{--                    <img src="{{asset('assets/img/Service/3.svg')}}" class="img-fluid" alt=""> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </section> --}}
    {{--    <!-- Sauna and Steam  --> --}}
    {{--    <section class="Sauna  bg-primary"> --}}
    {{--        <div class="container pt-5"> --}}
    {{--            <div class="row row-cols-1  row-cols-md-1 row-cols-lg-2 mt-5  "> --}}
    {{--                <div class="col  px-0  "> --}}
    {{--                    <div class=" text-lg-start text-md-center"> --}}
    {{--                        <img src="{{asset('assets/img/Service/4.svg')}}" class="img-fluid" alt=""> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--                <div class="col  ps-5 px-0"> --}}
    {{--                    <div class=" ps-4"> --}}
    {{--                        <h2 class="text-warning mb-4 pe-5">ساونا و بخار </h2> --}}
    {{--                        <p class="text-white fs-25 pe-5 ps-5">تعتبر غرف الساونا والبخار من وسائل الراحة الشهيرة التي --}}
    {{--                            توفر الاسترخاء والفوائد الصحية المختلفة. تشتمل الساونا عادةً على بيئة حرارية جافة ، يتم --}}
    {{--                            إنشاؤها عادةً بواسطة موقد يعمل بحرق الخشب أو سخان كهربائي ، بينما توفر غرفة البخار حرارة --}}
    {{--                            رطبة ناتجة عن مولد بخار. تحفز كلتا البيئتين التعرق ، والذي يمكن أن يساعد في تطهير الجسم عن --}}
    {{--                            طريق التخلص من السموم والشوائب.</p> --}}
    {{--                        <a href="Sauna & Steam.html" class="text-decoration-none "> --}}
    {{--                            <p class="text-white fs-25 pe-5  text-end pe-0 fw-light"> --}}
    {{--                                اقرأ المزيد عن الخدمة --}}
    {{--                                <img src="{{asset('assets/img/Service/arrow.svg')}}" class="me-3  arrowsize  " alt=""> --}}
    {{--                            </p> --}}
    {{--                        </a> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </section> --}}
    {{--    <!-- Massage  --> --}}
    {{--    <section class="Massage   bg-primary"> --}}
    {{--        <div class="container pt-5 pb-5 "> --}}
    {{--            <div class="row  row-cols-1  row-cols-md-1 row-cols-lg-2 mt-5 pt-3 pb-5 "> --}}
    {{--                <div class="col  px-0 ps-5 "> --}}
    {{--                    <h2 class="text-warning mb-4 ">تدليك </h2> --}}
    {{--                    <p class="text-white fs-25 ps-5">التدليك ممارسة علاجية تتضمن التلاعب بأنسجة الجسم الرخوة لتعزيز --}}
    {{--                        الاسترخاء وتقليل توتر العضلات وتخفيف الانزعاج الجسدي. إنها تقنية شفاء عمرها قرون تم استخدامها --}}
    {{--                        عبر الثقافات وهي معروفة بفوائدها العديدة. أثناء التدليك ، يقوم ممارس ماهر بتطبيق حركات الضغط --}}
    {{--                        والعجن والفرك لاستهداف مناطق معينة من الجسم.</p> --}}
    {{--                    <a href="Massage.html" class="text-decoration-none "> --}}
    {{--                        <p class="text-white fs-25 ps-5  text-end pe-0 fw-light"> --}}
    {{--                            اقرأ المزيد عن الخدمة --}}
    {{--                            <img src="{{asset('assets/img/Service/arrow.svg')}}" class="me-3  arrowsize  " alt=""> --}}
    {{--                        </p> --}}
    {{--                    </a> --}}
    {{--                </div> --}}
    {{--                <div class="col   text-lg-end text-md-center px-0"> --}}
    {{--                    <img src="{{asset('assets/img/Service/5.svg')}}" class="img-fluid" alt=""> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </section> --}}

@endsection

@section('scripts')
@endsection
