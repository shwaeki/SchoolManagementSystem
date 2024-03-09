@extends('layouts.app')

@push('styles')
    <link href="{{ asset("assets/plugins/css/light/editors/quill/quill.snow.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/plugins/css/dark/editors/quill/quill.snow.css")  }}" rel="stylesheet" type="text/css"/>
    <style>
        .ql-container {
            min-height: 700px;
            height: 100%;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .ql-editor {
            height: 100%;
            flex: 1;
            overflow-y: auto;
            width: 100%;
        }

        .ql-editor p, .ql-editor ol, .ql-editor ul, .ql-editor pre, .ql-editor blockquote, .ql-editor h1, .ql-editor h2, .ql-editor h3, .ql-editor h4, .ql-editor h5, .ql-editor h6 {
            margin: 10px;
        }
    </style>

@endpush

@section('content')
    <form action="{{route('reports.update',$report)}}" method="post"
          class="mb-5" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="statbox widget box box-shadow mb-3">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4> تقديل بانات القالب </h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area-normal">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم القالب</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{old('name',$report->name)}}" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="subject" class="form-label">عنوان القالب</label>
                            <input type="text" id="subject" name="subject" class="form-control"
                                   value="{{old('subject',$report->subject)}}" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="type" class="form-label"> نوع القالب</label>
                            <select class="form-select" name="type" id="type" required>
                                <option value="student" {{ old('type',$report->type) == "student" ? 'selected' : ''}}>
                                    طالب
                                </option>
                                <option value="teacher" {{old('type',$report->type) == "teacher" ? 'selected' : ''}}>
                                    مدرس
                                </option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="contentText" class="form-label">محتوى القالب</label>
                    <div class="mb-2">
                        <button type="button" data-name="[name]" class="btn btn-delete add_dynamic">
                            الاسم
                        </button>
                        <button type="button" data-name="[identification]" class="btn btn-delete add_dynamic">
                            رقم الهوية
                        </button>
                        <button type="button" data-name="[birthDate]" class="btn btn-delete add_dynamic">
                            تاريخ الميلاد
                        </button>
                        <button type="button" data-name="[date]" class="btn btn-delete add_dynamic">
                            تاريخ اليوم
                        </button>
                        <button type="button" class="btn btn-delete" data-bs-toggle="modal"
                                data-bs-target="#dynamicInputModal">
                            قيمة متغيرة
                        </button>
                    </div>
                    <textarea id="contentText" name="content" class="form-control d-none" rows="20"
                              required>{!! old('content',$report->content)  !!}</textarea>
                    <div id="editor-container">{!! old('content',$report->content) !!}</div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary ml-3">تعديل</button>
    </form>

    <div class="modal fade" id="dynamicInputModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة قيمة متغيرة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="dynamicInputName" class="form-label">اسم الحقل </label>
                        <input type="email" class="form-control" id="dynamicInputName">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">اغلاق</button>
                    <button type="button" class="btn btn-primary" id="dynamicInputSubmit">اضافة</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset("assets/plugins/src/editors/quill/quill.js")  }}"></script>

    <script>

        var quill = new Quill('#editor-container', {
            modules: {
                toolbar: [
                    [{header: [1, 2, 3, 4, 5, 6, false]}],
                    ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                    [{align: []}],
                    [{'direction': 'rtl'}]
                ]
            },
            theme: 'snow'
        });
        quill.on('text-change', function (delta, oldDelta, source) {
            $('#contentText').val(quill.container.firstChild.innerHTML);
        });

        $(".add_dynamic").click(function () {
            var field = $(this).attr("data-name");

            quill.focus();
            quill.insertText(quill.getSelection(true), " " + field + " ");
        });

        $("#dynamicInputSubmit").click(function () {
            var field_name = $("#dynamicInputName").val();
            if (field_name == '') {
                Swal.fire({
                    title: "خطأ!",
                    text: "يجب ادخال اسم الحقل!",
                    icon: "error"
                });
                return;
            }

            var field = "[dynamic name='" + field_name + "']";

            quill.focus();
            quill.insertText(quill.getSelection(true), " " + field + " ");
            $("#dynamicInputModal").modal('hide');
        });

    </script>
@endpush
