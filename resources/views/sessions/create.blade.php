@extends('layouts.master')

@section('title', 'إنشاء حصة تدربية جديدة')

@section('content')

    <div class=" d-flex justify-content-center">


        <div class="card card-success w-50 mt-3">
            <div class="card-header">
                <h3 class="card-title">إنشاء حصة تدربية:</h3>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form method="POST" action="{{ route('sessions.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Session Name -->
                    <div class="form-group mb-3">
                        <label for="name">اسم الحصة التدريبية</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>

                    <!-- Choose Day -->
                    <div class="form-group mb-3">
                        <label class="form-label">اليوم</label>
                        <select name="day" class="form-control">
                            <option value="0" disabled selected>=== حدد اليوم ===</option>
                            <option value="Saturday">السبت</option>
                            <option value="Sunday">الأحد</option>
                            <option value="Monday">الاثنين</option>
                            <option value="Tuesday">الثلاثاء</option>
                            <option value="Wednesday">الأربعاء</option>
                            <option value="Thursday">الخميس</option>
                            <option value="Friday">الجمعة</option>
                        </select>
                    </div>

                    <!-- Start -->
                    <div class="form-group mb-3">
                        <label>البدء في الحصة التدريبية</label>
                        <input class="form-control" type="datetime-local" name="started_at">
                    </div>

                    <!-- Finish -->
                    <div class="form-group mb-3">
                        <label>الانتهاء من الحصةالتدريبية</label>
                        <input class="form-control" type="datetime-local" name="finished_at">
                    </div>

                    <!-- Coaches -->
                    @role('admin')
                        <div class="form-group mb-3">
                            <label>مدرب</label>
                            <select name="coach_id[]" class="form-control" id="coachName" multiple>
                                @foreach ($coaches as $coach)
                                    <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endrole

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success py-2 px-4">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('script')

@stop
