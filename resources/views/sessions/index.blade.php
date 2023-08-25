@extends('layouts.master')

@section('title', 'الحصص التدريبية')


@section('content')
    <div class="container-fluid">
        <div class="px-4">
            @error('msg')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex justify-content-center mb-3">
                @role('admin')
                    <a href="{{ route('sessions.create') }}" class="btn btn-success my-3">إنشاء حصة تدربية</a>
                @endrole
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">جميع الحصص التدريبية</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table text-center table-hover">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>اليوم</th>
                                <th>المدرب</th>
                                <th>تبدأ في</th>
                                <th>ينتهي عند</th>
                                @role('admin')
                                    <th>أجراءات</th>
                                @endrole
                                @auth('coach')
                                    <th>أجراءات</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessions as $session)
                                <tr>
                                    <td>{{ $session->name }}</td>
                                    <td>
                                        @foreach (explode(',', $session->days) as $day)
                                            {{ trim($day) }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <ul style="list-style: none;" class="list-group list-group-flush">
                                            @foreach ($session->coaches as $coach)
                                                <li>{{ $coach->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ date('h:i a', strtotime($session->started_at)) }}</td>
                                    <td>{{ date('h:i a', strtotime($session->finished_at)) }}</td>


                                    @role('admin')
                                        <td class="d-flex justify-content-center">

                                            @role('admin|coach')
                                                <a href="{{ route('sessions.show', $session->id) }}"
                                                    class="btn btn-md btn-info mr-2" title="show"><i class="fas fa-eye"></i></a>
                                            @endrole

                                            {{--                                    @if (count($session->attendances) == 0) --}}
                                            <a href="{{ route('sessions.edit', ['id' => $session->id]) }}"
                                                class="btn btn-md btn-warning mr-2" title="Edit"><i
                                                    class="fas fa-edit"></i></a>
                                            {{--                                    @endif --}}

                                            @if (count($session->attendances) == 0)
                                                <form method="POST"
                                                    action="{{ route('sessions.destroy', ['id' => $session->id]) }}">
                                                    @CSRF
                                                    @method('delete')
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-md btn-danger show-alert-delete-box"
                                                        data-toggle="tooltip" title='Delete'><i class="fas fa-times"
                                                            disabled></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    @endrole
                                    @auth('coach')
                                        <td>
                                            <a href="{{ route('sessions.show', $session->id) }}"
                                                class="btn btn-md btn-info mr-2" title="show"><i class="fas fa-eye"></i></a>
                                        </td>
                                    @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>

    @include('layouts.alertScript')
@stop
