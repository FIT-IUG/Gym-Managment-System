@extends('layouts.master')
@section('title', 'عرض معلومات المدرب')

@section('content')
    <div class="container p-5">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">معلومات المدرب : <b>{{ $coach->name }}</b></h3>

                <div class="card-tools row">
                    <div class="col-md-4">
                        <a class="btn btn-tool btn-info" href="{{ route('coaches.edit', $coach->id) }}"><i
                                class="fas fa-pencil-alt"></i></a>
                    </div>
                    <form class="col-md-4" action="{{ route('coaches.destroy', $coach->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-md btn-info show-alert-delete-box btn-tool"
                            data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <p class="card-text text-secondary">الاسم : <span
                        class="text-light font-weight-bold">{{ $coach->name }}</span></p>
                <div class="form-group d-flex justify-content-evenly">
                    <p class="card-text text-secondary">الصورة : </p>
                    <div class="m-3">
                        <img src="{{ url('imgs/coaches/' . $coach->profile_image) }} " width="100px" height="100px"
                            alt="">
                        <input type="hidden" name="oldimg" value="{{ $coach->profile_image }}">
                    </div>
                </div>
                <p class="card-text text-secondary">الوصف : </br></br><span
                        class="text-light font-weight-bold">{{ $coach->description }}</span></p>
            </div>

        </div>
    </div>
@stop

@section('script')
    @include('layouts.alertScript')
@stop
