@extends('layouts.master')

@section('title', 'Create New Session')

@section('content')

    <div class=" d-flex justify-content-center">


        <div class="card card-success w-50 mt-3">
            <div class="card-header">
                <h3 class="card-title">Create Section:</h3>
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



                    <!-- Select City -->
                    {{-- @role('admin')
                        <div class="form-group mb-3">
                            <label for="city">City</label>
                            <select class="form-control" name="city" id="cityName">
                                <option value="0" disabled selected>=== Select City ===</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endrole --}}

                    {{-- @role('cityManager|gymManager')
                        <input type="text" hidden name="city" value="{{ Auth::user()->city_id }}" id="cityName" />
                    @endrole --}}

                    <!-- Select Gym -->
                    {{-- @hasanyrole('admin|cityManager')
                        <div class="form-group mb-3">
                            <label for="gym_id">Gym</label>
                            <select name="gym_id" class="form-control" id="gymName">
                                @role('cityManager')
                                    <option value="0" disabled selected>=== Select Gym ===</option>
                                    @foreach ($gyms as $gym)
                                        <option value="{{ $gym->id }}">{{ $gym->name }}</option>
                                    @endforeach
                                @endrole
                            </select>
                        </div>
                    @endhasanyrole --}}

                    {{-- @role('gymManager')
                        <input type="text" hidden name="gym_id" value="{{ Auth::user()->gym_id }} " id="gymName" />
                    @endrole --}}

                    <!-- Session Name -->
                    <div class="form-group mb-3">
                        <label for="name">Session Name</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>

                    <!-- Choose Day -->
                    <div class="form-group mb-3">
                        <label class="form-label">Day</label>
                        <select name="day" class="form-control">
                            <option value="0" disabled selected>=== Select Day ===</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                        </select>
                    </div>

                    <!-- Start -->
                    <div class="form-group mb-3">
                        <label>Start Session</label>
                        <input class="form-control" type="datetime-local" name="started_at">
                    </div>

                    <!-- Finish -->
                    <div class="form-group mb-3">
                        <label>Finish Session</label>
                        <input class="form-control" type="datetime-local" name="finished_at">
                    </div>

                    <!-- Coaches -->
                    @role('admin')
                        <div class="form-group mb-3">
                            <label>Coach</label>
                            <select name="coach_id[]" class="form-control" id="coachName" multiple>
                                {{-- @role('gymManager') --}}
                                    @foreach ($coaches as $coach)
                                        <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                                    @endforeach
                                {{-- @endrole --}}
                            </select>
                        </div>
                    @endrole

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success py-2 px-4">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

<!-- Get Gyms Related To City -->
@section('script')

{{--    @role('admin')--}}
{{--        <script type="text/javascript">--}}
{{--            $('#cityName').on('change', function(e) {--}}
{{--                var city_id = e.target.value;--}}
{{--                $.get('/json-gym?city_id=' + city_id, function(data) {--}}
{{--                    console.log(data);--}}
{{--                    $('#gymName').empty();--}}
{{--                    $('#gymName').append(--}}
{{--                        '<option value="0" disabled selected="true">=== Select Gym ===</option>');--}}

{{--                    $.each(data, function(index, gymObj) {--}}
{{--                        $('#gymName').append('<option value="' + gymObj.id + '">' + gymObj.name +--}}
{{--                            '</option>');--}}
{{--                    })--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endrole--}}

    <!-- Get Coaches Related To Gym -->
    @role('admin|cityManager')
        <script type="text/javascript">
            $('#gymName').on('change', function(e) {
                    $('#coachName').empty();

                    $.each(data, function(index, coachObj) {
                        $('#coachName').append('<option value="' + coachObj.id + '">' + coachObj.name +
                            '</option>');
                    })
            });
        </script>
    @endrole
@stop
