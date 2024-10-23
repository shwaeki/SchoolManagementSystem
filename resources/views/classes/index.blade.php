@extends('layouts.app')

@section('content')

    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-8">
                    <h4> قائمة الفصول التعليمية</h4>
                </div>

                <div class="col-4 text-end align-self-center">
                    @can('create-school-class')
                        <a href="{{route('school-classes.create')}}" class="btn btn-primary"> اضافة </a>
                    @endcan

                    @can('view-archive-school-class-list')
                        <a href="{{route('school-classes.archives')}}" class="btn btn-primary"> الارشيف </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
