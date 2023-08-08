@extends('layouts.master')
@section('title', 'الخدمات المشتراة')

@section('content')
    <div class="container-fluid">
        <div class="px-4">
            @error('msg')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @role('admin')
                <div class="d-flex justify-content-center mb-3">
                    <a href="{{ route('buyPackage.create') }}" class="btn btn-success my-3">شراء خدمة</a>
                </div>
            @endrole
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">جميع المشتريات</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table text-center table-hover">
                        <thead>
                            <tr>
                                <th class="col-2">اسم الخدمة</th>
                                <th class="col-2">السعر المدفوع</th>
                                <th class="col-2">تم شراؤها في</th>
                                <th class="col-2">العميل</th>
                                <th class="col-2">الإجراءات</th>
                            </tr>
                        </thead>
                        @foreach ($boughtPackageCollection as $package)
                            <tr>
                                <td>{{ $package->package ? $package->package->name : 'not found' }}</td>
                                <td>{{ $package->price }} </td>
                                <td>{{ \Carbon\Carbon::parse($package->created_at)->format('Y-m-d') }} </td>
                                <td>{{ $package->user ? $package->user->name : 'not found' }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('buyPackage.show', ['package' => $package->id]) }}"
                                        class="btn btn-info"><i class="fas fa-eye"></i></a>
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

    @include('layouts.alertScript')

@stop
