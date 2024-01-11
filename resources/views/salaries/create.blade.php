@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>اضافة ملف قسائم رواتب جديد</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{ route('salaries.store') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="date" class="form-label">الشهر و السنة</label>
                            <input type="text" id="date" name="date"
                                   class="form-control @error('date') is-invalid @enderror"
                                   value="{{old('date')}}" required>
                            @error('date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="file" class="form-label"> الملف </label>
                            <input class="form-control @error('file') is-invalid @enderror"
                                   type="file" name="file" id="file" accept="application/pdf" >
                            @error('file')
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
