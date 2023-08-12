@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-right" dir="rtl">
                <div class="card my-5" style="box-shadow: #b3b81770 0px 0px 4px 1px">
                    <section class="content-header col-md-12 mt-3">
                        <h1 class="text-center font-weight-bold" style="color: #fcfc06;">تسجيل الدخول</h1>
                    </section>
                    <div class="card-body">
                        {{--                        @if ($msg != 0)--}}
                        {{--                            <div class="alert alert-info">{{ $msg }}</div>--}}
                        {{--                        @endif--}}
                        @if(session('msg'))
                            <div class="alert alert-success d-flex justify-content-between">
                                {{ session('msg') }}
                                <button id="cancelButton" class="btn btn-sm btn-link"><i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif
                        <form id="quickForm" method="POST" action="{{ route('coach.login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('البريد الإلكتروني') }}</label>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="أدخل البريد الإلكتروني">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('كلمة المرور') }}</label>

                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required
                                       autocomplete="current-password" placeholder="كلمة المرور">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <div class="form-check d-flex justify-content-between">
                                        <input
                                            class="custom-control-input custom-control-input-yellow custom-control-input-outline"
                                            type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" style="color: #fcfc06;"
                                               for="remember">{{ __('تذكرنى') }}</label>
                                        @if (Route::has('password.request'))
                                            <a class="float-right font-weight-bold" style="color: #fcfc06;"
                                               href="{{ route('coaches.password.request') }}">
                                                {{ __('نسيت كلمة السر؟') }}
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-warning text-black font-weight-bold"
                                        style="background-color: #fcfc06;border-color: #fcfc06;">
                                    {{ __('تسجيل الدخول') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('cancelButton').addEventListener('click', function () {
            document.querySelector('.alert-success').style.display = 'none';
        });
    </script>
@endsection
