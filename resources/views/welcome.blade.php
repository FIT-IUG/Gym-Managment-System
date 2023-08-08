@extends('layouts.app')

@section('title')
    مرحبا بكم في نادي سوبر جيم
@endsection

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="text-center">
                <h1>مرحبا بكم في نادي سوبر جيم</h1>
                <div class="card-body">
                    <h5 class="mb-4">تسجيل الدخول للمتابعة</h5>
                    <a class="btn btn-info mx-2 text-light fw-bold shadow-sm" href="{{ route('login') }}">تسجيل الدخول</a>
                </div>
            </div>
        </div>
    </div>
@endsection
