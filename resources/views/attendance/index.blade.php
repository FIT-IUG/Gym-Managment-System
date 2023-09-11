@extends('layouts.master')
@section('title', 'الحضور')

@section('content')
    <div class="container-fluid">
        <div class="col-md-12 px-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">سجل الحضور</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table text-center table-hover">
                        <thead>
                            <tr>
                                <th scope="col">المتدرب</th>
                                <th scope="col">البريد إلكتروني</th>
                                <th scope="col">الحصة التدريبية</th>
                                <th scope="col">تبدأ</th>
                                <th scope="col">تنتهى </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->users->name }}</td>
                                    <td>{{ $attendance->users->email }}</td>
                                    <td>{{ $attendance->trainingSessions ? $attendance->trainingSessions->name : 'Not Found !' }}
                                    </td>
                                    <td>{{ $attendance->trainingSessions ? date('h:i a', strtotime($attendance->trainingSessions->started_at)) : 'Not Found !' }}
                                    </td>
                                    <td>{{ $attendance->trainingSessions ? date('h:i a', strtotime($attendance->trainingSessions->finished_at)) : 'Not Found !' }}
                                    </td>
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
