@extends('layouts.app')

@section('content')

    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-8">
                    <h4> قائمة المعلمين</h4>
                </div>

                <div class="col-4 text-end align-self-center">
                    @can('create-teacher')
                        <a href="{{route('teachers.create')}}" class="btn btn-primary"> اضافة </a>
                    @endcan

                    @can('archive-teacher')
                        <a href="{{route('teachers.archives')}}" class="btn btn-primary"> الارشيف </a>
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
