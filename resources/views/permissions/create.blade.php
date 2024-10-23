@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>اضافة صلاحية جديدة</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{route('permissions.store')}}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            <label for="name" class="form-label"> المفتاح </label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name')}}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            <label for="display_name" class="form-label"> اسم العرض </label>
                            <input type="text" id="display_name" name="display_name"
                                   class="form-control @error('display_name') is-invalid @enderror"
                                   value="{{old('display_name')}}" required>
                            @error('display_name')
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
