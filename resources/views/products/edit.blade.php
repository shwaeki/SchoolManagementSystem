@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>تعديل معلومات المنتج - {{$product->name}}  </h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name',$product->name)}}" required>
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
                                <option {{ old('category',$product->category) == "كتب" ? 'selected' : '' }} value="كتب">كتب</option>
                                <option {{ old('category',$product->category) == "الزر المدرسي" ? 'selected' : '' }} value="الزر المدرسي">الزر المدرسي</option>
                                <option {{ old('category',$product->category) == "قرطاسية" ? 'selected' : '' }} value="قرطاسية">قرطاسية</option>
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
                                   value="{{old('price',$product->price)}}" required>
                            @error('price')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            <label for="description" class="form-label"> الوصف </label>
                            <textarea type="text" id="description" name="description"
                                      class="form-control  @error('description') is-invalid @enderror">{{old('description',$product->description)}}
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
                                       @if(old('status',$product->status ) == "1") checked @endif id="status">
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
