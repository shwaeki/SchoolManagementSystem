@extends('layouts.app')

@push('styles')
    <style>
        iframe {
            width: 100%;
            height: 700px;
            overflow: hidden;
            border: none;
            box-shadow: 0 0 2rem 0 rgb(136 152 170 / 15%);
            border-radius: 0.375rem;
        }
    </style>
@endpush

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <h4> ملفاتي الخاصة</h4>
        </div>
        <div class="widget-content widget-content-area">
            <iframe src="/filemanager"></iframe>
        </div>
    </div>

@endsection
