@extends('layouts.app')

@section('content')

    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-8">
                    <h4> قائمة مستخدمي النظام </h4>
                </div>

                <div class="col-4 text-end align-self-center">
                    @can('create-user')
                        <a href="{{route('users.create')}}" class="btn btn-primary"> اضافة </a>
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
