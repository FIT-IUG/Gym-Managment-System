@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <section class="content-header col-md-12 mt-3 pb-0">
                        <h1 class="text-center text-info font-weight-bold">تسجيل حساب</h1>
                    </section>
                    <div class="card-body">
                        <form id="quickForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <!-- username -->
                                <div class="form-group">
                                    <input name="name" type="text"
                                        class="form-control  @error('name') is-invalid @enderror " placeholder="الاسم">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- email -->
                                <div class="form-group">
                                    <input name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="البريد إلكتروني">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- DOB -->
                                <div class="form-group">
                                    <input name="date_of_birth" type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror">
                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="input-group my-4 mx-3">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio1" name="gender"
                                            value="male" checked>
                                        <label for="customRadio1" class="custom-control-label mr-4">ذكر</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio2" name="gender"
                                            value="female">
                                        <label for="customRadio2" class="custom-control-label mr-4">أنثى</label>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="form-group mb-3 mt-4">
                                    {{--                                <label for="description">description</label> --}}
                                    <textarea name="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                        id="description" placeholder="هل لديك أمراض أو بيانات صحية" aria-describedby="titleHelp"></textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <input name="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="كلمة المرور">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <input id="password-confirm" name="confirmPassword" type="password"
                                        class="form-control  @error('confirmPassword') is-invalid @enderror"
                                        placeholder="تأكيد كلمة المرور" autocomplete="new-password">
                                    @error('confirmPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group text-center mb-0">
                                    <button type="submit" class="btn btn-primary font-weight-bold mt-3">
                                        {{ __('تسجيل') }}
                                    </button>
                                    <div class="mt-3">
                                        <label class="font-weight-light">هل لديك حساب؟ <a class="text-info"
                                                href="{{ route('login') }}">تسجيل الدخول</a></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
