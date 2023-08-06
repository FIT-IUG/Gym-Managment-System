@extends('layouts.master')

@section('title', 'Banned Users')

@section('content')
<div class="container-fluid">
    <div class="px-4">
        @error('msg')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Banned Users</h3>
            </div>
            <div class="card-body">
                <table id="table" class="table text-center table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>profile Img</th>
                            <th>Banned At</th>
                            <th>UnBan</th>
                        </tr>
                    </thead>

                    @foreach ($bannedUsers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><img src="{{ url('imgs/users/' . $user->profile_img) }} " width="50px" height="50px" alt="not found" /></td>
                        <td>{{ $user->banned_at }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('users.unban', $user->id) }}" class="btn btn-md btn-light" title="UnBan"><i class="fas fa-user-slash"></i></a>
                        </td>
                    </tr>
                    @endforeach
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
@stop
