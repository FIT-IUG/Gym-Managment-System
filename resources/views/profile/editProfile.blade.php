@extends('layouts.master')

@section('title', 'المستخدمون')


@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-9 mx-auto">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <form class="mt-5 w-50 mx-auto" action="{{ route('profile.update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                                <div class="mb-3">
                                    <label class="form-label"> الاسم </label>
                                    <input type="text" value="{{ auth()->user()->name }}" name="name"
                                        class="form-control">
                                </div>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label class="form-label"> البريد الإلكتروني </label>
                                    <input type="email" value="{{ auth()->user()->email }}" name="email"
                                        class="form-control">
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group mb-3">
                                    <label>تاريخ الميلاد</label>
                                    <input class="form-control" type="date" name="date_of_birth"
                                        value="{{ auth()->user()->date_of_birth }}">
                                </div>
                                @error('date_of_birth')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group d-flex justify-content-between">
                                    <div class="">
                                        <label for="">صورة الملف الشخصي</label>
                                        <input type="file" class="form-control-file" name="profile_img"
                                            aria-describedby="fileHelpId">
                                        <small id="fileHelpId" class="form-text text-muted">png or jpg</small>
                                    </div>
                                    <div class="">
                                        <img src="{{ url('imgs/users/' . Auth::user()->profile_img) }} " width="100px"
                                            height="100px" alt="">
                                        <input type="hidden" name="oldimg" value="{{ Auth::user()->profile_img }}">
                                    </div>
                                </div>
                                @error('img')
                                    <div class="alert alert-danger p-1">{{ $message }}</div>
                                @enderror

                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-light" href="{{ route('profile.editPassword') }}">تحديث
                                        كلمة المرور</a>
                                    <button type="submit" class="btn btn-success py-2 px-4">تحديث</button>
                                </div>

                            </form> <!-- /.card -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
