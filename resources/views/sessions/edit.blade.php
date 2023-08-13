@extends('layouts.master')

@section('title', 'تعديل الحصة التدريبية')

@section('content')

    <div class=" d-flex justify-content-center">
        <div class="card card-warning w-50 mt-3">
            <div class="card-header">
                <h3 class="card-title">تعديل الحصة التدريبية : <b>{{ $session->name }}</b></h3>
            </div>
            <div class="card-body">
                <form class="px-5 py-3" method="POST" action="{{ route('sessions.update', ['id' => $session['id']]) }}">
                    @csrf
                    @method('put')

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group mb-3">
                        <label for="started_at">تبدأ في</label>
{{--                        <input name="started_at" type="datetime-local" value="{{ $session['started_at'] }}"--}}
{{--                               class="form-control" id="started_at">--}}
                        <input class="form-control" type="time" value="{{ $session['started_at'] }}" name="started_at"
                               id="started_at">
                    </div>
                    <div class="form-group mb-3">
                        <label for="finished_at">ينتهي عند</label>
{{--                        <input name="finished_at" type="datetime-local" value="{{ $session['finished_at'] }}"--}}
{{--                               class="form-control" id="finished_at">--}}
                        <input class="form-control" type="time" value="{{ $session['finished_at'] }}"
                               name="finished_at" id="finished_at">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning py-2 px-4">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
