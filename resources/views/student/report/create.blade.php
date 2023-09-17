@extends('layouts.app')

@push('styles')
    <link href="{{ asset("assets/plugins/css/light/editors/quill/quill.snow.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/plugins/css/dark/editors/quill/quill.snow.css")  }}" rel="stylesheet" type="text/css"/>
    <style>
        .ql-container {
            min-height:700px;
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
    </style>

@endpush

@section('content')
    <form action="{{route('student-reports.store')}}" method="post"
          class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="statbox widget box box-shadow mb-3">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4> أصافة قالب جديد</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area-normal">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم القالب</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{old('name')}}" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="subject" class="form-label">عنوان القالب</label>
                            <input type="text" id="subject" name="subject" class="form-control"
                                   value="{{old('subject')}}" required>
                        </div>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="contentText" class="form-label">محتوى القالب</label>
                    <div class="mb-2">
                        <button type="button" data-name="[name]" class="btn btn-delete add_dynamic">
                            اسم الطالب
                        </button>
                        <button type="button" data-name="[identification]" class="btn btn-delete add_dynamic">
                            رقم الهوية
                        </button>
                        <button type="button" data-name="[birthDate]" class="btn btn-delete add_dynamic">
                            تاريخ الميلاد
                        </button>
                    </div>
                    <textarea id="contentText" name="content" class="form-control d-none" rows="20" required></textarea>
                    <div id="editor-container"></div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary ml-3">أصافة</button>
    </form>
@endsection

@push('scripts')

    <script src="{{ asset("assets/plugins/src/editors/quill/quill.js")  }}"></script>


    <script>

        var quill = new Quill('#editor-container', {
            modules: {
                toolbar: [
                    [{header: [1, 2, 3, 4, 5, 6, false]}],
                    ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                    [{ 'direction': 'rtl' }]
                ]
            },
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            $('#contentText').val(quill.container.firstChild.innerHTML);
        });

        $(".add_dynamic").click(function () {
            var field = $(this).attr("data-name");

            quill.focus();
            quill.insertText( quill.getSelection(true), " "+field+" ");
        });


    </script>
@endpush
