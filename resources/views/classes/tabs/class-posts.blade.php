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

                        <div class="table-responsive">
                            <table
                                class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">المحتوى</th>
                                    <th scope="col">الصور</th>
                                    <th scope="col">اضيف بواسطة</th>
                                    <th scope="col">تاريخ الاضافة</th>
                                    <th scope="col"> خيارات</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($posts as $post)

                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->content }}</td>
                                        <td>
                                            @if($post->photos->count() > 0)
                                                @foreach( $post->photos as $photo)
                                                    <div style="cursor: pointer" onclick="deleteItem(this)"
                                                         class="delete-image d-inline-block"
                                                         data-item="{{ route('posts.image.destroy', $photo->id) }}">
                                                        <img src="{{ asset($photo->image_path) }}" width="100"
                                                             alt="imgate">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $post->postable->name }}</td>
                                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <button class="btn btn-light-warning text-warning edit-post-btn"
                                                    data-id="{{ $post->id }}"
                                                    data-content="{{ $post->content }}">
                                                <i class="far fa-edit"></i>
                                            </button>

                                            <button class="btn btn-light-danger text-danger" onclick="deleteItem(this)"
                                                    data-item=" {{ route('posts.destroy', $post) }} ">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


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

                        @if(Auth::guard('web')->check() )
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="add_all_classes"
                                   name="add_all_classes">
                            <label class="form-check-label" for="add_all_classes">
                                اضافة الى جميع الفصول الدراسية
                            </label>
                        </div>
                        @endif

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">إضافة المنشور</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPostModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editPostForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل المنشور</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editContentText" class="form-label">المحتوى</label>
                            <textarea class="form-control" id="editContentText" name="content" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="editImages" class="form-label">صور جديدة</label>
                            <input class="form-control" type="file" id="editImages" name="images[]" multiple>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">تحديث المنشور</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endpush


@push("scripts")

    <script>
        $(document).on('click', '.edit-post-btn', function () {
            var postId = $(this).data('id');
            var postContent = $(this).data('content');
            $('#editPostForm').attr('action', '/posts/' + postId);
            $('#editContentText').val(postContent);
            $('#editPostModal').modal('show');
        });
    </script>

    @if ($errors->has('methods') || $errors->has('month') || $errors->has('objectives'))
        <script>
            $(document).ready(function () {
                $('#addMonthlyPlanModal').modal('show');
            });
        </script>
    @endif
@endpush
