@extends('Dashboard.layouts.master')
@section('css')

@endsection
@section('title')
    فاتورة مجموعة خدمات
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <a href="{{route('Invoices.Group')}}"><h4 class="content-title mb-0 my-auto">الفواتير</h4></a><span>/

                    مجموعة خدمات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <livewire:group-invoices />
                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

@endsection
