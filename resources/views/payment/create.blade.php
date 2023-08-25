@extends('layouts.master')
@section('title', 'شراء خدمة')

@section('content')
    <div class=" d-flex justify-content-center">
        <div class="card card-success w-50 mt-3">
            <div class="card-header">
                <h3 class="card-title">شراء خدمة:</h3>
            </div>
            <div class="card-body">
                <form class="px-5 py-3" action="{{ route('payment.store') }}" method="post">
                    @csrf
                    <!-- Select User -->
                    @hasanyrole('admin')
                        <div class="form-group mb-3">
                            <label>اختر المستخدم</label>
                            <select id="selectedUser" name="user_id" class="form-control">
                                <option value="0" disabled selected>=== اختر المستخدم ===</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endhasanyrole

                    @role('client')
                        <input type="text" hidden name="user_id" value="{{ $users }}" />
                    @endrole

                    <!-- Select Package -->
                    <div class="form-group mb-3">
                        <label>حدد الحزمة</label>
                        <select id="selectedPackage" name="package_id" class="form-control">
                            <option value="0" disabled selected>=== حدد الحزمة ===</option>
                            @foreach ($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>حدد الحصة التدريبية</label>
                        <select id="selectedPackage" name="session_id" class="form-control">
                            <option value="0" disabled selected>=== حدد الحصة التدريبية ===</option>
                            @foreach ($sessions as $session)
                                <option value="{{ $session->id }}">{{ $session->name }} |
                                    {{ date('h:i a', strtotime($session->started_at)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success py-2 px-4">شراء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('script')
    {{-- @role('admin') --}}
    {{-- <script type="text/javascript"> --}}
    {{--    $('#cityName').on('change', function(e) { --}}
    {{--        var city_id = e.target.value; --}}
    {{--        $.get('/json-gym?city_id=' + city_id, function(data) { --}}
    {{--            $('#gymName').empty(); --}}
    {{--            $('#gymName').append( --}}
    {{--                '<option value="0" disabled selected="true">=== Select Gym ===</option>'); --}}

    {{--            $.each(data, function(index, gymObj) { --}}
    {{--                $('#gymName').append('<option value="' + gymObj.id + '">' + gymObj.name + --}}
    {{--                    '</option>'); --}}
    {{--            }) --}}
    {{--        }); --}}
    {{--    }); --}}
    {{-- </script> --}}
    {{-- @endrole --}}

    @error('message')
        <script type="text/javascript">
            $(document).ready(function() {
                $(window).on('load', function() {
                    swal({
                        title: "You can't buy this package",
                        text: "Complete your form Data",
                        icon: "error",
                        type: "error",
                        confirmButtonColor: '#8CD4F5',
                        confirmButtonText: 'Ok',
                    });
                });
            });
        </script>
    @enderror
@endsection
