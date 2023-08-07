@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>اضافة دور جديد</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{route('roles.store')}}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            <label for="name" class="form-label"> الاسم </label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name')}}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="row">
                            @foreach ($permissions as $key => $permission)
                                <div class="col-3">
                                    <div class="mb-1 p-2 d-inline-block">

                                        <input type="checkbox" name="permissions[]" value="{{ $key }}"
                                               class="form-check-input" id="{{ $permission }}">
                                        <label for="{{$permission}}" class="form-check-label"> {{$permission}} </label>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>


                </div>

                <button type="submit" class="btn btn-primary ml-3">اضافة</button>

            </form>
        </div>
    </div>
@endsection
