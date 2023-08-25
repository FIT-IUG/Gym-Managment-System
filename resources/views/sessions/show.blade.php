@extends('layouts.master')
@section('title', 'عرض معلومات الحصة التدريبية')

@section('content')
    <div class="container p-5">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">معلومات الحصة التدريبية : <b>{{ $session->name }}</b></h3>

                @role('admin')
                    <div class="card-tools row">
                        <div class="col-md-4">
                            <a class="btn btn-tool btn-info" href="{{ route('sessions.edit', $session->id) }}"><i
                                    class="fas fa-pencil-alt"></i></a>
                        </div>
                        <form class="col-md-4" action="{{ route('sessions.destroy', $session->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-md btn-info show-alert-delete-box btn-tool"
                                data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                        </form>
                    </div>
                @endrole
            </div>

            <div class="card-body">
                <p class="card-text text-secondary">الاسم : <span
                        class="text-light font-weight-bold">{{ $session->name }}</span> </p>
                <p class="card-text text-secondary">تبدأ في : <span
                        class="text-light font-weight-bold">{{ date('h:i a', strtotime($session->started_at)) }}</span>
                </p>
                <p class="card-text text-secondary">ينتهي عند : <span
                        class="text-light font-weight-bold">{{ date('h:i a', strtotime($session->finished_at)) }}</span>
                </p>
            </div>


        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">المتدربين في الحصة التدربية</h3>
            </div>
            <form action="{{ route('session.attend', $session) }}" method="POST">
                @csrf
                <div class="card-body">
                    <table id="table" class="table text-center table-hover">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                @foreach (explode(',', $session->days) as $day)
                                    <th>{{ trim($day) }}</th>
                                @endforeach
                                @role('admin')
                                    {{-- <th>أجراءات</th> --}}
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    @foreach (explode(',', $session->days) as $day)
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input
                                                    class="custom-control-input custom-control-input-yellow custom-control-input-outline"
                                                    type="checkbox"
                                                    id="customCheckbox_{{ $user->id }}_{{ trim($day) }}"
                                                    name="users[{{ $user->id }}][{{ trim($day) }}]">
                                                <label for="customCheckbox_{{ $user->id }}_{{ trim($day) }}"
                                                    class="custom-control-label"></label>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-default float-right">save</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('script')
    @include('layouts.alertScript')
@stop
