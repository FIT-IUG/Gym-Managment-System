<!DOCTYPE html>
<html lang="arb" dir="rtl">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--  font-awesome/6.1.1/ css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <!--  boxicons@2.1.2/css css-->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <!-- BS v 5.2  -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}"/>
    <!-- BS icons v 1.9.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/join.css')}}"/>
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('dist/img/superGym.png')}}">
    <title>JOIN US</title>
</head>

<body dir="rtl">

<!-- main section -->
<main class="pt-0 pt-lg-4 pb-4">
    <div class="container bg-secondary-op rounded-4 p-5 text-right">
        <div class="px-0 px-lg-5 px-sm-0  px-md-0">
            <div class="px-0 px-lg-5 px-sm-0 px-md-0">
                <form class="row px-0 px-lg-5 px-sm-0 px-md-0 fw-light" id="quickForm" method="POST"
                      action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-white">انضم إلينا</h1>
                    <p class="fs-25 text-light opacity-75 mt-2 mb-4 ">املأ طلبك وسيتم التحقق منه.</p>
                    <div class="col-12 mt-4">
                        <label for=""
                               class="form-label fs-25 text-light opacity-75">الاسم
                        </label>
                        <input name="name" type="text"
                               class="form-control @error('name') is-invalid @enderror bggg fs-25 py-3 ps-4 border-0"
                               placeholder="الاسم"
                        >
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <!-- email -->
                    <div class="col-12 mt-4">
                        <label for="" class="form-label fs-25 text-light opacity-75">البريد الإلكتروني</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror bggg
                               fs-25 py-3 ps-4 border-0" placeholder="البريد الإلكتروني"
                        >
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <!-- Gender -->
                    <div class="input-group my-4 mx-3 align-center">
                        <label for=""
                               class="form-label fs-25 text-light opacity-75">الجنس
                        </label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-yellow custom-control-input-outline"
                                   type="radio" id="customRadio1" name="gender"
                                   value="male" checked>
                            <label for="customRadio1" class="custom-control-label mr-4 text-light">ذكر</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-yellow custom-control-input-outline"
                                   type="radio" id="customRadio2" name="gender"
                                   value="female">
                            <label for="customRadio2" class="custom-control-label mr-4 text-light">أنثى</label>
                        </div>
                    </div>
                    <!-- DOB -->
                    <div class="col-12 mt-4">
                        <label for="" class="form-label fs-25 text-light opacity-75">تاريخ الميلاد</label>
                        <input name="date_of_birth" type="date"
                               class="form-control @error('date_of_birth') is-invalid @enderror bggg fs-25 py-3 ps-4 border-0"
                        >
                        @error('date_of_birth')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <!-- Description -->
                    <div class="col-12 mt-4">
                        <label for="" class="form-label fs-25 text-light opacity-75">أمراض او اعراض صحية</label>
                        <textarea name="description" type="text"
                                  class="form-control @error('description') is-invalid @enderror bggg fs-25 py-3 ps-4 border-0"
                                  id="description"
                                  placeholder="هل لديك أمراض أو بيانات صحية"></textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--                    <div class="col-12 mt-4">--}}
                    {{--                        <label for="inputState" class="form-label fs-25 text-light opacity-75">خطة الأسعار</label>--}}
                    {{--                        <select id="inputState" class="form-select bggg text-white-50 py-3 ps-4 border-0" placeholder="bggg fs-25 py-3 ps-4 border-0">--}}
                    {{--                            <option  class="">اختيار خطة العضوية</option>--}}
                    {{--                            <option class="">--}}
                    {{--                                <span>40</span>--}}
                    {{--                                <p>/1شهر</p>--}}
                    {{--                            </option>--}}
                    {{--                            <option class="">--}}
                    {{--                                <span>100</span>--}}
                    {{--                                <p>/3شهور</p>--}}
                    {{--                            </option>--}}
                    {{--                            <option class="">--}}
                    {{--                                <span>180</span>--}}
                    {{--                                <p>/6شهور</p>--}}
                    {{--                            </option>--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}
                    <!-- Password -->
                    <div class="col-12 mt-4">
                        <label for="" class="form-label fs-25 text-light opacity-75">كلمة السر</label>
                        <input name="password" type="password"
                               class="form-control @error('password') is-invalid @enderror bggg fs-25 py-3 ps-4 border-0"
                               placeholder="كلمة السر">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <!-- Confirm Password -->
                    <div class="col-12 mt-4">
                        <label for="" class="form-label fs-25 text-light opacity-75">تأكيد كلمة السر</label>
                        <input id="password-confirm" name="confirmPassword" type="password"
                               class="form-control @error('confirmPassword') is-invalid @enderror bggg fs-25 py-3 ps-4 border-0"
                               placeholder="تأكيد كلمة السر" autocomplete="new-password">
                        @error('confirmPassword')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary w-100 fs-25 py-3 ps-4">ارسل</button>
                        <div class="mt-3">
                            <label class="font-weight-light text-muted text-white-50">هل لديك حساب ؟ <a
                                    class="text-info"
                                    href="{{ route('signIn') }}">تسجيل
                                    دخول</a></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
</body>

</html>
