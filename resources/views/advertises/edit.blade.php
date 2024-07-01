@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>تعديل معلومات الاعلان - {{$advertise->title}}  </h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{ route('advertises.update', $advertise) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                        <div class="col-12 col-md-12">
                            <div class="mb-3">
                                <label for="title" class="form-label">العنوان</label>
                                <input type="text" id="title" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{old('title',$advertise->title)}}" required>
                                @error('title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-3">
                                <label for="description" class="form-label"> المحتوى </label>
                                <textarea type="text" id="description" name="description"
                                          class="form-control  @error('description') is-invalid @enderror">{{old('description',$advertise->description)}}
                            </textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="status"
                                           @if(old('status',$advertise->status ) == "1") checked @endif id="status">
                                    <label class="form-check-label" for="status">الحالة</label>
                                </div>
                            </div>
                        </div>

                </div>
                <button type="submit" class="btn btn-primary ml-3">تعديل</button>
            </form>

        </div>
    </div>
@endsection
