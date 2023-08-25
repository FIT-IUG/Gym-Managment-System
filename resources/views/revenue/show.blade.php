@extends('layouts.master')
@section('title', 'عرض تفاصيل الشراء')

@section('content')
    <div class="container p-5">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">معلومات شراء</h3>

                <div class="card-tools row">
                    @role('admin')
                        <form class="col-md-4" action="{{ route('revenue.destroy', $boughtPackage->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-md btn-info show-alert-delete-box btn-tool"
                                data-toggle="tooltip" title='Delete'><i class="fas fa-times"></i></button>
                        </form>
                    @endrole
                </div>
            </div>
            <div class="card-body">
                <p class="card-text text-secondary">اسم العميل : <span
                        class="text-light font-weight-bold">{{ $boughtPackage->user->name }}</span></p>
                <p class="card-text text-secondary">البريد الإلكتروني للعميل : <span
                        class="text-light font-weight-bold">{{ $boughtPackage->user->email }}</span></p>
                <p class="card-text text-secondary">اسم الخدمة : <span
                        class="text-light font-weight-bold">{{ $boughtPackage->name }}</span></p>
                <p class="card-text text-secondary">السعر المدفوع : <span
                        class="text-light font-weight-bold">{{ $boughtPackage->price }}</span></p>
                <p class="card-text text-secondary">تم شراؤها في :<span
                        class="text-light font-weight-bold">{{ \Carbon\Carbon::parse($boughtPackage->created_at)->format('Y-m-d') }}
                    </span>
                </p>
            </div>
        </div>
    </div>
@stop

@section('script')
    @include('layouts.alertScript')
@stop
