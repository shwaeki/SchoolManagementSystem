@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>اضافة اعلان جديد</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{ route('advertises.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            <label for="title" class="form-label">العنوان</label>
                            <input type="text" id="title" name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{old('title')}}" required>
                            @error('title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            <label for="description" class="form-label"> المحتوى </label>
                            <textarea type="text" id="description" name="description"
                                      class="form-control  @error('description') is-invalid @enderror">{{old('description')}}
                            </textarea>
                            @error('description')
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
