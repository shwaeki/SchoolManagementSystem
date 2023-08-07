@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>اضافة سنة دراسية جديد</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{ route('academic-years.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name')}}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label"> الحالة </label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                <option value="1" selected>فعال</option>
                                <option {{old('status') == '0' ? 'selected' : '' }} value="0">غير فعال</option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">تاريخ البدأ </label>
                            <input type="date" id="start_date" name="start_date"
                                   class="form-control  @error('start_date') is-invalid @enderror"
                                   value="{{old('start_date')}}" required>
                            @error('start_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="end_date" class="form-label">تاريخ الانتهاء </label>
                            <input type="date" id="end_date" name="end_date"
                                   class="form-control  @error('end_date') is-invalid @enderror"
                                   value="{{old('end_date')}}" required>
                            @error('end_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                </div>

                <button type="submit" class="btn btn-primary ml-3">اضافة</button>
            </form>

        </div>
    </div>
@endsection
