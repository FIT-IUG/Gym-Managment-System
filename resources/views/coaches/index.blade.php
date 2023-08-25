@extends('layouts.master')

@section('title', 'المدربون')

@section('content')
    <div class="container-fluid">
        <div class="px-4">
            @error('msg')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex justify-content-center mb-3">
                <a href="{{ route('coaches.create') }}" class="btn btn-success my-3">إضافة مدرب جديد</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">جميع المدربين</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table text-center table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الصورة</th>
                                <th>تخصص</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coaches as $coach)
                                <tr>
                                    <td>{{ $coach->id }}</td>
                                    <td>{{ $coach->name }}</td>
                                    <td><img src="{{ url('imgs/coaches/' . $coach->profile_image) }}" width="50px"
                                            height="50px" alt="not found" /></td>
                                    <td>{{ $coach->description ? $coach->description : '-' }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('coaches.show', $coach->id) }}" class="btn btn-md btn-info mr-2"
                                            title="show"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('coaches.edit', ['id' => $coach->id]) }}"
                                            class="btn btn-md btn-warning mr-2" title="Edit"><i
                                                class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('coaches.destroy', ['id' => $coach->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-md btn-danger show-alert-delete-box px-3"
                                                data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i>
                                            </button>
                                        </form>
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
