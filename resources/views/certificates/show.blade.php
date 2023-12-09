@extends('layouts.app')

@push('styles')
    <link href="{{ asset("assets/css/light/users/account-setting.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/users/account-setting.css")  }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("assets/css/light/components/tabs.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/components/tabs.css")  }}" rel="stylesheet" type="text/css"/>

@endpush

@section('content')

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2 class="mb-3"> معلومات الشهادة - {{$certificate->name}}</h2>

                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="info-tab" data-bs-toggle="tab"
                                    href="#info" role="tab" aria-selected="true">
                                <i class="fas fa-info-circle"></i>
                                الرئيسية
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="fields-tab" data-bs-toggle="tab" href="#fields"
                                    role="tab" aria-selected="false" tabindex="-1">
                                <i class="fas fa-folder-open"></i>
                                مجالات الشهادة
                            </button>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="tab-content" id="animateLineContent-4">
                <div class="tab-pane fade show active" id="info" role="tabpanel">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="col-9">
                                            <h6> البيانات الشخصية </h6>
                                        </div>
                                        <div class="col-3 text-end">
                                            <a href="{{route('certificates.edit',['certificate'=>$certificate])}}"
                                               class="btn btn-primary"> تعديل </a>
                                        </div>
                                    </div>
                                    <div class="row">


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade " id="fields" role="tabpanel" aria-labelledby="fields-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">

                                    <div class="row">
                                        <div class="col-9">
                                            <h6> مجالات الشهادة</h6>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#fieldsModal"> اضافة
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">المجال</th>
                                                        <th scope="col">خيارات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($certificate->fields as $field)
                                                        <tr class="table-primary">
                                                            <td><strong>{{ $field->field_name }}</strong></td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#categoriesModalField{{ $field->id }}">
                                                                    <i class="far fa-plus"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        @if(count($field->categories) > 0)
                                                            <tr>
                                                                <td>
                                                                    <ul class="mb-0">
                                                                        @foreach($field->mainCategories as $category)
                                                                            <li class="mb-2">
                                                                                {{ $category->name }}
                                                                                @if($category->subcategories->isNotEmpty())
                                                                                    <ul>
                                                                                        @foreach($category->subcategories as $subcategory)
                                                                                            <li>{{ $subcategory->name }}</li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>


    <div class="modal fade" id="fieldsModal">
        <div class="modal-dialog">
            <form action="{{route('certificate-fields.store')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">اضافة مجال جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="certificate_id" value="{{$certificate->id}}">
                        <div class="mb-3">
                            <label for="field_name" class="form-label">الاسم</label>
                            <input type="text" id="field_name" name="field_name"
                                   class="form-control @error('field_name') is-invalid @enderror"
                                   value="{{old('field_name')}}" required>
                            @error('field_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-delete" data-bs-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">اضافة</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @foreach($certificate->fields as $field)
        <div class="modal fade" id="categoriesModalField{{$field->id}}">
            <div class="modal-dialog">
                <form action="{{route('certificate-categories.store')}}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">اضافة مجال جديد</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="certificate_field_id" value="{{$field->id}}">
                            <div class="mb-3">
                                <label for="field_name" class="form-label">اسم التصنيف</label>
                                <input type="text" id="field_name" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{old('name')}}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="parent_id" class="form-label">التصنيف الاب</label>
                                <select name="parent_id" id="parent_id" class="form-select">
                                    <option value="" selected>غير محدد</option>
                                    @foreach($field->mainCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-delete" data-bs-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-primary">اضافة</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

@endsection
