@extends('layouts.master')

@section('title', 'Users')

@section('content')
    <div class="container-fluid">
        <div class="px-4">
            @error('msg')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex justify-content-center w-100 mb-3">
                @role('admin')
                <div class="d-flex flex-grow-0 justify-content-around w-50 mb-3">
                    <a href="{{ route('users.create') }}" class="btn btn-success  my-3">Add New Client</a>
                    {{--                    <a href="{{ route('users.pend') }}" class="btn btn-primary  my-3">Pending Client</a>--}}
                    <a href="{{ route('users.banned') }}" class="btn btn-dark  my-3">Banned Client</a>
                </div>
                @endrole
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Clients</h3>
                </div>
                <div class="card-body">
                    @role('admin')
                    <table id="table" class="table text-center table-hover">
                        <thead>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            {{-- <th>National ID</th> --}}
                            <th>profile Img</th>
                            {{-- @role('admin')
                                <th>City</th>
                            @endrole --}}
                            {{-- @role('admin|cityManager')
                                <th>Gym</th>
                            @endrole --}}
                            <th>Controllers</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                {{-- <td>{{ $user->national_id }}</td> --}}
                                <td><img src="{{ url('imgs/users/' . $user->profile_img) }} " width="50px"
                                         height="50px" alt="not found"/></td>
                                {{-- @role('admin')
                                    <td>{{ $user->gym->city ? $user->gym->city->name : 'Not Found !' }}</td>
                                @endrole
                                @role('admin|cityManager')
                                    <td>{{ $user->gym ? $user->gym->name : 'Not Found !' }}</td>
                                @endrole --}}
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('users.show', $user->id) }}"
                                       class="btn btn-md btn-info mr-2"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-md btn-warning"><i
                                            class="fas fa-edit"></i></a>
                                    <form class="col-md-4" action="{{ route('users.destroy', $user->id) }}"
                                          method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-md btn-danger show-alert-delete-box"
                                                data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @if ($user->isBanned())
                                        <a href="{{ route('users.unban', $user->id) }}"
                                           class="btn btn-md btn-light mr-2" title="UnBan"><i
                                                class="fas fa-user-slash"></i></a>
                                    @elseif ($user->isNotBanned())
                                        <a href="{{ route('users.ban', $user->id) }}"
                                           class="btn btn-md btn-dark px-3 mr-2" title="Ban"><i
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Session Name</th>
                                <th>Client Image</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->description ? $user->description : '-' }}</td>
                                    <td>
                                        <ul style="list-style: none;" class="list-group list-group-flush">
                                            @foreach($attendances as $attendance)
                                                @if($attendance->users->id === $user->id)
                                                    <li> {{ $attendance->trainingSessions->name }}</li><br>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td><img src="{{ asset('imgs/users/Client.png') }} " class="img-circle elevation-2"
                                             width="50px"
                                             height="50px" alt="not found"/></td>
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
        $(document).ready(function () {
            $('#table').DataTable();
        });
    </script>

    @include('layouts.alertScript')
@stop
