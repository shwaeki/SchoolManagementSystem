@push("tab_button")
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="class-years-tab" data-bs-toggle="tab" href="#class-years"
                role="tab" aria-controls="class-years" aria-selected="false" tabindex="-1">
            <i class="fas fa-history"></i>
            السنوات السابقة
        </button>
    </li>

@endpush

@push("tab_content")
    <div class="tab-pane fade" id="class-years" role="tabpanel"
         aria-labelledby="years-info-tab">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                <form class="section general-info">
                    <div class="info">
                        <div class="row">
                            <div class="col-9">
                                <h6> السنوات السابقة</h6>
                            </div>

                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">السنة الدراسية</th>
                                    <th scope="col">المدرس المشرف</th>
                                    <th scope="col"> الكود</th>
                                    <th scope="col"> الشهادة</th>
                                    <th scope="col">عدد الطلاب</th>
                                    <th scope="col">اضيف بواسطة</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($class_years as $year)
                                    <tr>
                                        <td>{{$year->academicYear->name}}</td>
                                        <td>{{$year->supervisorTeacher->name}}</td>
                                        <td>{{$year->code}}</td>
                                        <td>{{$year->certificate?->name}}</td>
                                        <td>{{count($year->students)}}</td>
                                        <td>{{$year->addedBy->name}}</td>
                                    </tr>
                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
@endpush
