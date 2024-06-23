@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>اضافة منتج جديد</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{ route('products.store') }}" method="POST">
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

                    <div class="col-6 col-md-3">
                        <div class="mb-3">
                            <label for="category" class="form-label"> التصنيف </label>
                            <select class="form-select @error('category') is-invalid @enderror"
                                    id="category" name="category" required>
                                <option selected disabled value="">اختر ...</option>
                                <option {{ old('category') == "كتب" ? 'selected' : '' }} value="كتب">كتب</option>
                                <option {{ old('category') == "الزر المدرسي" ? 'selected' : '' }} value="كتب">الزر المدرسي</option>
                                <option {{ old('category') == "قرطاسية" ? 'selected' : '' }} value="كتب">قرطاسية</option>
                            </select>
                            @error('category')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="price" class="form-label"> السعر </label>
                            <input type="text" id="price" name="price"
                                   class="form-control only-integer @error('price') is-invalid @enderror"
                                   value="{{old('price')}}" required>
                            @error('price')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            <label for="description" class="form-label"> الوصف </label>
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
