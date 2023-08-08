@extends('layouts.master')
@section('title', 'إضافة عميل جديد')

@section('content')
    <div class=" d-flex justify-content-center">
        <div class="card card-success w-50 mt-3">
            <div class="card-header">
                <h3 class="card-title">إضافة عميل جديد :</h3>
            </div>
            <div class="card-body">
                <form class="px-5 py-3" id="create-form" action="{{ route('users.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- name --}}
                    <div class="form-group mb-3">
                        <label>اسم العميل</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', '') }}">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- email --}}
                    <div class="form-group mb-3">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email', '') }}">
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- DOB --}}
                    <div class="form-group mb-3">
                        <label>تاريخ الميلاد</label>
                        <input class="form-control" type="date" id="date_of_birth" name="date_of_birth">
                    </div>
                    @error('date_of_birth')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- Gender --}}
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="gender" value="male" id="gender1" checked>
                        <label class="form-check-label" for="gender1"> ذكر </label>
                        <input class="form-check-input" type="radio" name="gender" value="female" id="gender2"
                            style=" margin-left:25px">
                        <label class="form-check-label" for="gender2" style=" margin-left:45px"> أنثى </label>
                    </div>

                    {{-- password --}}
                    <div class="form-group mb-3">
                        <label>كلمة المرور</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password', '') }}">
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group mb-3">
                        <label>تأكيد كلمة المرور</label>
                        <input type="password" name="confirmPassword" class="form-control"
                            value="{{ old('confirmPassword', '') }}">
                    </div>
                    @error('confirmPassword')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- profile img --}}
                    <div class="">
                        <div class="w-100">
                            <label for="">صورة الملف الشخصي</label>
                            <input type="file" class="form-control w-100 bg-dark pt-1" name="profile_img"
                                aria-describedby="fileHelpId" value="{{ old('profile_img', '') }}">
                            <small id="fileHelpId" class="form-text text-muted">فقط : png or jpg</small>
                        </div>
                    </div>
                    @error('img')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group mb-3 mt-4">
                        <label for="description">وصف</label>
                        <textarea name="description" type="text" class="form-control" id="description"
                            placeholder="هل أنت لديك أمراض أو البيانات الصحية" aria-describedby="titleHelp"></textarea>
                    </div>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success py-2 px-4">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

{{-- scripts --}}
@section('script')
    {{-- <script type="text/javascript">
    $('#cityName').on('change', function(e) {
        console.log(e);
        var city_id = e.target.value;
        $.get('/json-gym?city_id=' + city_id, function(data) {
            console.log(data);
            $('#gymName').empty();
            $('#gymName').append(
                '<option value="0" disable="true" selected="true">=== Select Gym ===</option>');

            $.each(data, function(index, gymObj) {
                $('#gymName').append('<option value="' + gymObj.id + '">' + gymObj.name +
                    '</option>');
            })
        });
    });
</script> --}}
@stop
