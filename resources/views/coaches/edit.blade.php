@extends('layouts.master')
@section('title')
    تعديل "{{ $coaches->name }}" معلومات
@endsection

@section('content')
    <div class=" d-flex justify-content-center">
        <div class="card card-warning w-50 mt-3">
            <div class="card-header">
                <h3 class="card-title">تعديل بيانات المدرب: <b>{{ $coaches->name }}</b></h3>
            </div>
            <div class="card-body">
                <form class="px-5 py-3" action="{{ route('coaches.update', ['id' => $coaches->id]) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <input type="hidden" name='id' value="{{ $coaches->id }}">

                    <div class="form-group mb-3">
                        <label for="name">الاسم</label>
                        <input name="name" id='name' type="text" value="{{ $coaches['name'] }}"
                               class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">وصف</label>
                        <textarea name="description" type="text" class="form-control" id="description"
                                  aria-describedby="titleHelp">{{ $coaches->description }}</textarea>
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
                    <div class="form-group d-flex justify-content-between">
                        <div class="">
                            <div class="w-100">
                                <label for="">صورة المدرب</label>
                                <input type="file" class="form-control w-100 bg-dark pt-1" name="profile_image"
                                       aria-describedby="fileHelpId" value="{{ old('profile_image', '') }}">
                                <small id="fileHelpId" class="form-text text-muted">فقط : png or jpg</small>
                            </div>
                        </div>
                        <div class="">
                            <img src="{{ url('imgs/coaches/' . $coaches->profile_image) }}" width="100px" height="100px"
                                 alt="">
                            <input type="hidden" name="profile_image" value="{{ $coaches->profile_image }}">
                        </div>
                    </div>

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning py-2 px-4">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        $('#cityName').on('change', function (e) {

            var city_id = e.target.value;
            $.get('/json-gym?city_id=' + city_id, function (data) {
                console.log(data);
                $('#gymName').empty();

                $.each(data, function (index, gymObj) {
                    $('#gymName').append('<option value="' + gymObj.id + '">' + gymObj.name +
                        '</option>');
                })
            });
        });
    </script>

@endsection
