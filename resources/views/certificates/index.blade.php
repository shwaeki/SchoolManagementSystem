@extends('layouts.app')

@section('content')

    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-8">
                    <h4> قائمة انواع الشهادات</h4>
                </div>

                @can('create-certificates')
                    <div class="col-4 text-end align-self-center">
                        <a href="{{route('certificates.create')}}" class="btn btn-primary"> اضافة </a>
                    </div>
                @endcan
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
