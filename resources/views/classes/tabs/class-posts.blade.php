@push("tab_button")
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="class-posts-tab" data-bs-toggle="tab"
                href="#class-posts"
                role="tab" aria-controls="class-posts" aria-selected="false"
                tabindex="-1">
            <i class="fas fa-image"></i>
            المنشورات
        </button>
    </li>
@endpush


@push("tab_content")
    <div class="tab-pane fade" id="class-posts" role="tabpanel"
         aria-labelledby="class-students-tab">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                <div class="section general-info">
                    <div class="info">

                        <div class="row mb-4 d-print-none">
                            <div class="col-9">
                                <h6 class="mb-0 ">المنشورات</h6>
                            </div>
                            <div class="col-3 text-end">

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#createPostModal">
                                    اضافة
                                </button>
                            </div>
                        </div>


                        <hr>

                        <h4 class="text-center py-5">
                            لا يوجد خطة شهرية لهذا الشهر
                        </h4>

                    </div>
                </div>


            </div>
        </div>

    </div>
@endpush



@push("html")
    <div class="modal fade" id="createPostModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="year_class_id" value="{{ $current_year_class->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPostModalLabel">إضافة منشور جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">


                        <div class="mb-3">
                            <label for="contentText" class="form-label">المحتوى</label>
                            <textarea class="form-control" id="contentText" name="content" rows="3"
                                      placeholder="اكتب المحتوى هنا..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">صور</label>
                            <input class="form-control" type="file" id="images" name="images[]" multiple>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">إضافة المنشور</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush


@push("scripts")

    @if ($errors->has('methods') || $errors->has('month') || $errors->has('objectives'))
        <script>
            $(document).ready(function () {
                $('#addMonthlyPlanModal').modal('show');
            });
        </script>
    @endif
@endpush
