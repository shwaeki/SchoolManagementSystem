@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>تعديل معلومات نوع الشهادة  - {{$certificate->name}}</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{ route('certificates.update',['certificate'=>$certificate]) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name',$certificate->name)}}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="age" class="form-label">عمر الطلاب</label>
                            <input type="text" id="age" name="age"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('age',$certificate->age)}}" required>
                            @error('age')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="class" class="form-label">صف الطلاب</label>
                            <input type="text" id="class" name="class"
                                   class="form-control @error('class') is-invalid @enderror"
                                   value="{{old('class',$certificate->class)}}" required>
                            @error('class')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary ml-3">تعديل</button>
            </form>

        </div>
    </div>
@endsection
