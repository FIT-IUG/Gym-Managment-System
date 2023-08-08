@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-5">
                    <section class="content-header col-md-12 mt-3">
                        <h1 class="text-center text-info font-weight-bold">تسجيل الدخول</h1>
                    </section>
                    <div class="card-body">
                        <form id="quickForm" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">البريد الإكتروني</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="ادخل البريد الإلكتروني">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label for="password">كلمة المرور</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password" placeholder="كلمة المررور">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <div class="form-check">
                                        <input class="custom-control-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label text-info" for="remember">تذكرني</label>
                                        @if (Route::has('password.request'))
                                            <a class="float-right text-info font-weight-bold"
                                                href="{{ route('password.request') }}">
                                                هل نسيت كلمة المرور؟
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-info font-weight-bold">
                                    تسجبل الدخول
                                </button>
                                <div id="clientRoleValue" class="mt-3">
                                    <label class="font-weight-light">تسجيل الدخول ك ? <a class="text-info"
                                            href="{{ route('coach.login_view') }}">مدرب</a></label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
