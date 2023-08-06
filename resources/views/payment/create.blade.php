@extends('layouts.master')
@section('title', 'Buy Package')

@section('content')
<div class=" d-flex justify-content-center">
    <div class="card card-success w-50 mt-3">
        <div class="card-header">
            <h3 class="card-title">Buy Package:</h3>
        </div>
        <div class="card-body">
            <form class="px-5 py-3" action="{{ route('payment.store') }}" method="post">
                @csrf

                <!-- Select City -->
{{--                @role('admin')--}}
{{--                <div class="form-group mb-3">--}}
{{--                    <label for="city">City</label>--}}
{{--                    <select class="form-control" name="city" id="cityName">--}}
{{--                        <option value="0" disabled selected>=== Select City ===</option>--}}
{{--                        @foreach ($cities as $city)--}}
{{--                        <option value="{{ $city->id }}">{{ $city->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                @endrole--}}

{{--                @hasanyrole('cityManager|gymManager|client')--}}
{{--                <input type="text" hidden name="city" value="{{$cities}}" id="cityName" />--}}
{{--                @endhasanyrole--}}

                <!-- Select Gym -->
{{--                @hasanyrole('admin|cityManager|client')--}}
{{--                <div class="form-group mb-3">--}}
{{--                    <label for="gym">Gym</label>--}}
{{--                    <select class="form-control" name="gym_id" id="gymName">--}}
{{--                        @role('cityManager|client')--}}
{{--                        <option value="0" disabled selected>=== Select Gym ===</option>--}}
{{--                        @foreach ($gyms as $gym)--}}
{{--                        <option value="{{ $gym->id }}">{{ $gym->name }}</option>--}}
{{--                        @endforeach--}}
{{--                        @endrole--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                @endhasanyrole--}}

{{--                @role('gymManager')--}}
{{--                <input type="text" hidden name="gym_id" value="{{$gyms}}" />--}}
{{--                @endrole--}}

                <!-- Select User -->
                @hasanyrole('admin|cityManager|gymManager')
                <div class="form-group mb-3">
                    <label>Select User</label>
                    <select id="selectedUser" name="user_id" class="form-control">
                        <option value="0" disabled selected>=== Select User ===</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endhasanyrole

                @role('client')
                <input type="text" hidden name="user_id" value="{{$users}}" />
                @endrole

                <!-- Select Package -->
                <div class="form-group mb-3">
                    <label>Select Package</label>
                    <select id="selectedPackage" name="package_id" class="form-control">
                        <option value="0" disabled selected>=== Select Package ===</option>
                        @foreach ($packages as $package)
                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success py-2 px-4">Buy</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('script')
{{--@role('admin')--}}
{{--<script type="text/javascript">--}}
{{--    $('#cityName').on('change', function(e) {--}}
{{--        var city_id = e.target.value;--}}
{{--        $.get('/json-gym?city_id=' + city_id, function(data) {--}}
{{--            $('#gymName').empty();--}}
{{--            $('#gymName').append(--}}
{{--                '<option value="0" disabled selected="true">=== Select Gym ===</option>');--}}

{{--            $.each(data, function(index, gymObj) {--}}
{{--                $('#gymName').append('<option value="' + gymObj.id + '">' + gymObj.name +--}}
{{--                    '</option>');--}}
{{--            })--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
{{--@endrole--}}

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
