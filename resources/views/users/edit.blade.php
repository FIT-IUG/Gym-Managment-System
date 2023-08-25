@extends('layouts.master')

@section('title')
    تعديل "{{ $user->name }}" معلومات
@endsection

@section('content')
    <div class=" d-flex justify-content-center">
        <div class="card card-warning w-50 mt-3">
            <div class="card-header">
                <h3 class="card-title">تعديل بيانات المستخدم: <b>{{ $user->name }}</b></h3>
            </div>
            <div class="card-body">
                <form class="px-5 py-3" action="{{ route('users.update', $user->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <input type="hidden" name="id" value="{{ $user->id }}">

                    {{-- manager name --}}
                    <div class="form-group mb-3">
                        <label>اسم العميل</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- email --}}
                    <div class="form-group mb-3">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- DOB --}}
                    <div class="form-group mb-3">
                        <label>تاريخ الميلاد</label>
                        <input class="form-control" type="date" name="date_of_birth" value="{{ $user->date_of_birth }}">
                    </div>
                    @error('date_of_birth')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning py-2 px-4">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
