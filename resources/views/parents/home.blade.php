@extends('layouts.auth')


@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="container mx-auto align-self-center">

        <div class="row">

            <div class="col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                <div class="card bg-white mt-3 mb-3">
                    <div class="card-body">

                            <div class="mb-3 text-center">
                                <img src="{{ asset("assets/img/logo.png") }}" width="180px">
                                <h2 class="text-center"> كشف علامات الطالب لسنة - {{$adminActiveAcademicYear->name}} </h2>
                            </div>



                            <div class="content position-relative">

                                <div>
                                    <table class="table table-sm table-bordered ">
                                        <thead>
                                        <tr>
                                            <th class="fw-bold rounded-0" scope="col">المجال و مخرجات التعلم</th>
                                            <th class="text-center fw-bold rounded-0" scope="col" colspan="3">علامة الفصل الاول</th>
                                            <th class="text-center fw-bold rounded-0" scope="col" colspan="3">علامة الفصل الثاني</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center fw-bold rounded-0" scope="col"></th>
                                            <th class="text-center fw-bold rounded-0" scope="col">دائماً</th>
                                            <th class="text-center fw-bold rounded-0" scope="col">أحياناً</th>
                                            <th class="text-center fw-bold rounded-0" scope="col">نادراً</th>
                                            <th class="text-center fw-bold rounded-0" scope="col">دائماً</th>
                                            <th class="text-center fw-bold rounded-0" scope="col">أحياناً</th>
                                            <th class="text-center fw-bold rounded-0" scope="col">نادرا</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($certificate->fields as $field)
                                            <tr class="table-primary text-center fw-bold">
                                                <td colspan="9"><strong>{{ $field->field_name }}</strong></td>
                                            </tr>
                                            @if(count($field->categories) > 0)
                                                @foreach($field->mainCategories as $category)
                                                    <tr class="{{count($category->subcategories) > 0 ? 'table-warning' : ''}}">
                                                        <td>{{ $category->name }}</td>

                                                        <td class="text-center py-0">
                                                            @if(isset($marks['first'][$category->id]) && $marks['first'][$category->id]['mark'] == "Always")
                                                                <i class="fa fa-check fa-2x"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center py-0">
                                                            @if(isset($marks['first'][$category->id]) && $marks['first'][$category->id]['mark'] == "Sometimes")
                                                                <i class="fa fa-check fa-2x"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center py-0">
                                                            @if(isset($marks['first'][$category->id]) && $marks['first'][$category->id]['mark'] == "Rarely")
                                                                <i class="fa fa-check fa-2x"></i>
                                                            @endif
                                                        </td>

                                                        <td class="text-center py-0">
                                                            @if(isset($marks['second'][$category->id]) && $marks['second'][$category->id]['mark'] == "Always")
                                                                <i class="fa fa-check fa-2x"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center py-0">
                                                            @if(isset($marks['second'][$category->id]) && $marks['second'][$category->id]['mark'] == "Sometimes")
                                                                <i class="fa fa-check fa-2x"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center py-0">
                                                            @if(isset($marks['second'][$category->id]) && $marks['second'][$category->id]['mark'] == "Rarely")
                                                                <i class="fa fa-check fa-2x"></i>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @if($category->subcategories->isNotEmpty())
                                                        @foreach($category->subcategories as $subcategory)
                                                            <tr>
                                                                <td>{{ $subcategory->name }}</td>

                                                                <td class="text-center py-0">
                                                                    @if(isset($marks['first'][$subcategory->id]) && $marks['first'][$subcategory->id]['mark'] == "Always")
                                                                        <i class="fa fa-check fa-2x"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center py-0">
                                                                    @if(isset($marks['first'][$subcategory->id]) && $marks['first'][$subcategory->id]['mark'] == "Sometimes")
                                                                        <i class="fa fa-check fa-2x"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center py-0">
                                                                    @if(isset($marks['first'][$subcategory->id]) && $marks['first'][$subcategory->id]['mark'] == "Rarely")
                                                                        <i class="fa fa-check fa-2x"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center py-0">
                                                                    @if(isset($marks['second'][$subcategory->id]) && $marks['second'][$subcategory->id]['mark'] == "Always")
                                                                        <i class="fa fa-check fa-2x"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center py-0">
                                                                    @if(isset($marks['second'][$subcategory->id]) && $marks['second'][$subcategory->id]['mark'] == "Sometimes")
                                                                        <i class="fa fa-check fa-2x"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center py-0">
                                                                    @if(isset($marks['second'][$subcategory->id]) && $marks['second'][$subcategory->id]['mark'] == "Rarely")
                                                                        <i class="fa fa-check fa-2x"></i>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <div class="row px-3 g-0">
                                        <div class="col-12">
                                            <div class="mb-3 mt-3">
                                                <p class="fs-5 fw-bold text-black">ملاحظات مربية الفصل الدراسي الاول</p>
                                                <p class="fs-6">{{$studentCertificate->first_notes ?? ''}}</p>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3 h4 mt-3">
                                                <p class="fs-5 fw-bold text-black">ملاحظات مربية الفصل الدراسي الثاني</p>
                                                <p class="fs-6">   {{$studentCertificate->second_notes ?? ''}}</p>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
