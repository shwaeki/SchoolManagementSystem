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
                                            <h6> بيانات الشهادة </h6>
                                        </div>
                                        <div class="col-3 text-end">
                                            <a href="{{route('certificates.edit',['certificate'=>$certificate])}}"
                                               class="btn btn-primary"> تعديل </a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">الاسم</label>
                                                <input type="text" id="name" class="form-control"
                                                       value="{{ $certificate->name }}" disabled>

                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="age" class="form-label">عمر الطلاب</label>
                                                <input type="text" id="age" class="form-control"
                                                       value="{{ $certificate->age }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="class" class="form-label">صف الطلاب</label>
                                                <input type="text" id="class" class="form-control"
                                                       value="{{ $certificate->class }}" disabled>
                                            </div>
                                        </div>

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
                                                                <button type="button" class="btn btn-primary add-field"
                                                                        data-field-id="{{ $field->id }}">
                                                                    <i class="far fa-plus"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-warning edit-field"
                                                                        data-field-id="{{ $field->id }}"
                                                                        data-field-name="{{ $field->field_name }}"
                                                                        data-field-order="{{ $field->field_order }}">
                                                                    <i class="far fa-edit"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        @if(count($field->categories) > 0)
                                                            <tr>
                                                                <td>
                                                                    <ul class="mb-0">
                                                                        @foreach($field->mainCategories as $category)
                                                                            <li class="mb-2">
                                                                                <div
                                                                                    class="d-flex justify-content-between">
                                                                                    {{ $category->name }}
                                                                                    <div>
                                                                                        @if($category->subcategories->isEmpty())
                                                                                            <button type="button"
                                                                                                    class="btn btn-dismiss btn-rounded mb-1"
                                                                                                    onclick="deleteItem(this)"
                                                                                                    data-item="{{route('certificate-categories.destroy', $category)}}">
                                                                                                <i class="far fa-times-circle text-danger"></i>
                                                                                            </button>
                                                                                        @endif
                                                                                        <button type="button"
                                                                                                class="btn btn-dismiss edit-category btn-rounded mb-1"
                                                                                                data-id="{{ $category->id }}"
                                                                                                data-name="{{ $category->name }}">
                                                                                            <i class="fas fa-pen text-warning"></i>
                                                                                        </button>

                                                                                    </div>
                                                                                </div>
                                                                                @if($category->subcategories->isNotEmpty())
                                                                                    <ul>
                                                                                        @foreach($category->subcategories as $subcategory)
                                                                                            <li>
                                                                                                <div
                                                                                                    class="d-flex justify-content-between">
                                                                                                    {{ $subcategory->name }}
                                                                                                    <div>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn btn-dismiss btn-rounded mb-1"
                                                                                                            onclick="deleteItem(this)"
                                                                                                            data-item="{{route('certificate-categories.destroy', $subcategory)}}">
                                                                                                            <i class="far fa-times-circle text-danger"></i>
                                                                                                        </button>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn btn-dismiss btn-rounded mb-1 edit-category"
                                                                                                            data-id="{{ $subcategory->id }}"
                                                                                                            data-name="{{ $subcategory->name }}">
                                                                                                            <i class="fas fa-pen text-warning"></i>
                                                                                                        </button>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>
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

    <div class="modal fade" id="fieldEditModal">
        <div class="modal-dialog">
            <form action="" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل بيانات المجال</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="field_id" id="field_id" value="">
                        <div class="mb-3">
                            <label for="field_name" class="form-label">الاسم</label>
                            <input type="text" id="field_name" name="field_name"
                                   class="form-control @error('field_name') is-invalid @enderror"
                                   value="{{old('field_name')}}" required>
                            @error('field_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="field_order" class="form-label">الترتيب </label>
                            <input type="text" id="field_order" name="field_order"
                                   class="form-control only-integer @error('field_order') is-invalid @enderror"
                                   value="{{old('field_order')}}" required>
                            @error('field_order')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-delete" data-bs-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">تعديل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="categoriesModalField">
        <div class="modal-dialog">
            <form action="{{route('certificate-categories.store')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">اضافة فئة جديدة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="certificate_field_id"
                               id="certificate_field_id" value="" required>
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

    <div class="modal fade" id="editCategoryModal">
        <div class="modal-dialog">
            <form id="editCategoryForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل التصنيف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="category_id" id="category_id">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">اسم التصنيف</label>
                            <input type="text" id="category_name" name="name"
                                   class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-delete" data-bs-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>

        $('.add-field').on('click', function () {
            var field_id = $(this).data('field-id');
            $('#certificate_field_id').val(field_id);

            $.ajax({
                url: '{{route('certificate-fields.categories')}}',
                type: 'GET',
                dataType: 'json',
                data: {field_id: field_id},
                success: function (response) {
                    if (response.result == true) {
                        var parentDropdown = $('#parent_id');
                        parentDropdown.empty();
                        parentDropdown.append('<option value="" selected>غير محدد</option>');

                        $.each(response.data, function (index, category) {
                            parentDropdown.append('<option value="' + category.id + '">' + category.name + '</option>');
                        });

                        $('#categoriesModalField').modal('show');
                    }
                },
            });

        });


        $('.edit-field').on('click', function () {
            var field_id = $(this).data('field-id');
            var field_name = $(this).data('field-name');
            var field_order = $(this).data('field-order');
            $('#fieldEditModal #field_id').val(field_id);
            $('#fieldEditModal #field_name').val(field_name);
            $('#fieldEditModal #field_order').val(field_order);


            var formAction = "{{ route('certificate-fields.update', -1) }}";
            formAction = formAction.replace('-1', field_id);
            $('#fieldEditModal form').attr('action', formAction);


            $('#fieldEditModal').modal('show');

        });

        $('.edit-category').on('click', function () {
            var category_id = $(this).data('id');
            var category_name = $(this).data('name');

            $('#category_id').val(category_id);
            $('#category_name').val(category_name);
            $('#editCategoryForm').attr('action', '{{ url("certificate-categories") }}/' + category_id);

            $('#editCategoryModal').modal('show');
        });
    </script>
@endpush

