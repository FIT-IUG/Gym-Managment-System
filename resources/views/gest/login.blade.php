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
    <link rel="stylesheet" href="{{asset('assets/css/join.css')}}"/>
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('dist/img/superGym.png')}}">
    <title>log in </title>
</head>

<body>

<!-- main section -->
<main class="d-flex justify-content-center  align-items-center">
    <div class="container bg-secondary-op rounded-4 p-5 WWW ">
        <div class="px-0 px-lg-5 px-sm-0  px-md-0 py-4">
            <div class="px-0 px-lg-5 px-sm-0 px-md-0">
                <form class="row px-0 px-lg-5 px-sm-0 px-md-0 fw-light" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1 class="text-white">تسجيل الدخول</h1>
                    <p class="fs-25 text-light opacity-75 mt-2 mb-4 ">يمكنك الحصول على البريد الإلكتروني وكلمة المرور
                        عند الاشتراك في
                        صالة الألعاب الرياضية.</p>
                    <div class="col-12 mt-4">
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror bggg fs-25 py-3 ps-4 border-0"
                               id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                               autofocus
                               placeholder="البريد الإلكتروني">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 mt-4">
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror bggg fs-25 py-3 ps-4 border-0"
                               id="password" name="password" required autocomplete="current-password"
                               placeholder="كلمة السر">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 form-check ms-3 pe-4 mt-3 d-flex justify-content-between">
                  <span>
                    <input type="checkbox" class="form-check-input bg-transparent border" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label f12 text-light " for="remember">تذكرنى</label>
                  </span>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="f12 text-warning text-decoration-none">نسيت
                                كلمة المرور؟</a>
                        @endif
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary w-100 fs-25 py-3 ps-4">تسجيل الدخول</button>
                        <div id="clientRoleValue" class="mt-3">
                            <label class="font-weight-light text-muted text-white-50">مستخدم جديد ؟ <a class="text-info"
                                                                                                       href="{{ route('signUp') }}">تسجيل
                                    حساب</a></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
</body>

</html>
