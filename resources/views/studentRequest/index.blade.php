@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-8">
                    <h4> قائمة طلبت الطلاب</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">

            <div class="row">
                <div class="col-12">
                    <select class="form-select form-select-sm" id="class" name="c">
                        <option selected value=""> جميع الفروع</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">
                                {{$school->name}} - {{$school->address}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{ $dataTable->table() }}
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
