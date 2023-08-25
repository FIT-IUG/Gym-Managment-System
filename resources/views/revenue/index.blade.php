@extends('layouts.master')

@section('title', 'الدخل')

@section('content')
    <div class="container-fluid">
        <div class="col-md-12 px-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">جميع المشتريات</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table text-center table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">اسم العميل</th>
                                <th class="text-center">البريد الإلكتروني للعميل</th>
                                <th class="text-center">اسم الخدمة</th>
                                <th class="text-center">السعر المدفوع</th>
                                @role('admin')
                                    <th>الإجراءات</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($boughtPackages as $boughtPackage)
                                <tr>
                                    <td>{{ $boughtPackage->user->name }}</td>
                                    <td>{{ $boughtPackage->user->email }}</td>
                                    <td>{{ $boughtPackage->name }}</td>
                                    <td>{{ $boughtPackage->price }} </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('revenue.show', $boughtPackage->id) }}"
                                            class="btn btn-md btn-info"><i class="fas fa-eye"></i></a>
                                        @role('admin')
                                            <form class="col-md-4" action="{{ route('revenue.destroy', $boughtPackage->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-md btn-danger show-alert-delete-box"
                                                    data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                                            </form>
                                        @endrole
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
