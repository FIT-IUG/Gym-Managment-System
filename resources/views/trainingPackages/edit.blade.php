@extends('layouts.master')
@section('title')
    تعديل "{{ $package->name }}" الخدمة
@stop

@section('content')
    <div class=" d-flex justify-content-center">
        <div class="card card-warning w-50 mt-3">
            <div class="card-header">
                <h3 class="card-title">تعديل الخدمة: <b>{{ $package->name }}</b></h3>
            </div>
            <div class="card-body">
                <form class="px-5 py-3" action="{{ route('trainingPackages.update', $package->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <input type="hidden" name="package_id" value="{{ $package->id }}">

                    <div class="form-group mb-3">
                        <label for="name">الاسم</label>
                        <input name="name" type="text" class="form-control" id="name"
                            value="{{ $package->name }}" aria-describedby="titleHelp">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group mb-3">
                        <label for="Desc">السعر</label>
                        <input name="price" type="text" class="form-control" value="{{ $package->price }} "
                            id="price" aria-describedby="titleHelp">
                    </div>
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="">
                        <div class="w-100">
                            <label for="">صورة الخدمة</label>
                            <input type="file" class="form-control w-100 bg-dark pt-1" name="image"
                                aria-describedby="fileHelpId" value="{{ old('image', '') }}">
                            <small id="fileHelpId" class="form-text text-muted">فقط : png or jpg</small>
                        </div>
                        <img src="{{ url('imgs/gym/' . $package->image) }}" width="40px" height="40px" alt="not found" />
                    </div>
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group mb-3">
                        <label for="description">الوصف</label>
                        <textarea name="description" type="text" class="form-control" id="description" aria-describedby="titleHelp">{{ $package->description }}</textarea>
                    </div>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning py-2 px-4">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
