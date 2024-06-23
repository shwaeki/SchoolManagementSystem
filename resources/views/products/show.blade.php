@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4> معلومات المنتج - {{$product->name}}  </h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">الاسم</label>
                        <input type="text" id="name"
                               class="form-control" value="{{$product->name}}" disabled>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="mb-3">
                        <label for="category" class="form-label"> التصنيف </label>
                        <select class="form-control" id="category" disabled>
                            <option {{ old('category',$product->category) == "كتب" ? 'selected' : '' }} value="كتب">
                                كتب
                            </option>
                            <option
                                    {{ old('category',$product->category) == "الزر المدرسي" ? 'selected' : '' }} value="كتب">
                                الزر المدرسي
                            </option>
                            <option {{ old('category',$product->category) == "قرطاسية" ? 'selected' : '' }} value="كتب">
                                قرطاسية
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="mb-3">
                        <label for="price" class="form-label"> السعر </label>
                        <input type="text" id="price" class="form-control" value="{{$product->price}}" disabled>
                    </div>
                </div>

                <div class="col-12 col-md-12">
                    <div class="mb-3">
                        <label for="description" class="form-label"> الوصف </label>
                        <textarea type="text" id="description" disabled class="form-control ">{{$product->description}}</textarea>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   @if($product->status  == "1") checked @endif id="status" disabled>
                            <label class="form-check-label" for="status">الحالة</label>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
