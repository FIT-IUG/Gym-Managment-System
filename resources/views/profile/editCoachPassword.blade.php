@extends('layouts.master')

@section('title', 'المدربون')


@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-9 mx-auto">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <form class="mt-5 w-50 mx-auto" action="{{ route('profile.updateCoachPassword') }}" method="post">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label for="">كلمة المرور الجديدة</label>
                                    <input type="password" class="form-control" name="newpassword"
                                        placeholder="أدخل كلمة المرور الجديدة">
                                </div>
                                @error('newpassword')
                                    <div class="alert alert-danger p-1">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="">كلمة المرور القديمة</label>
                                    <input type="password" class="form-control" name="oldpassword"
                                        placeholder="أدخل كلمة المرور القديمة الخاصة بك">
                                </div>
                                @error('oldpassword')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @if ($msg != 0)
                                    <div class="alert alert-danger">{{ $msg }}</div>
                                @endif


                                <div class="d-flex justify-content-end mt-4">
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
