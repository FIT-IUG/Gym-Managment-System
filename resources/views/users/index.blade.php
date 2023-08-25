@extends('layouts.master')

@section('title', 'المستخدمون')

@section('content')
    <div class="container-fluid">
        <div class="px-4">
            @error('msg')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex justify-content-center w-100 mb-3">
                @role('admin')
                    <div class="d-flex flex-grow-0 justify-content-around w-50 mb-3">
                        <a href="{{ route('users.create') }}" class="btn btn-success  my-3">إضافة عميل جديد</a>
                        {{--                    <a href="{{ route('users.pend') }}" class="btn btn-primary  my-3">Pending Client</a> --}}
                        <a href="{{ route('users.banned') }}" class="btn btn-dark  my-3">العملاء المحظورين</a>
                    </div>
                @endrole
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">جميع العملاء</h3>
                </div>
                <div class="card-body">
                    @role('admin')
                        <table id="table" class="table text-center table-hover">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>صورة الملف الشخصي</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><img src="{{ url('imgs/users/' . $user->profile_img) }} " width="50px"
                                                height="50px" alt="not found" /></td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-md btn-info mr-2"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-md btn-warning"><i
                                                    class="fas fa-edit"></i></a>
                                            <form class="col-md-4" action="{{ route('users.destroy', $user->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-md btn-danger show-alert-delete-box"
                                                    data-toggle="tooltip" title='حذف'><i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                            @if ($user->isBanned())
                                                <a href="{{ route('users.unban', $user->id) }}"
                                                    class="btn btn-md btn-light mr-2" title="إلغاء الحظر"><i
                                                        class="fas fa-user-slash"></i></a>
                                            @elseif ($user->isNotBanned())
                                                <a href="{{ route('users.ban', $user->id) }}"
                                                    class="btn btn-md btn-dark px-3 mr-2" title="حظر"><i
                                                        class="fas fa-user"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endrole
                    @auth('coach')
                        <table id="table" class="table text-center table-hover">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>الوصف</th>
                                    <th>الحصة التدريبية</th>
                                    <th>صورة العميل</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->description ? $user->description : '-' }}</td>
                                        <td>
                                            <ul style="list-style: none;" class="list-group list-group-flush">
                                                @foreach ($user->trainingSessions as $session)
                                                    <li>{{ $session->name }}</li><br>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td><img src="{{ asset('imgs/users/Client.png') }} " class="img-circle elevation-2"
                                                width="50px" height="50px" alt="not found" /></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endauth
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
