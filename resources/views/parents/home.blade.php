@extends('layouts.auth')
@push('styles')
    <style>
        .student-info {
            position: absolute;
            top: 49.1%;
            width: 100%;
            text-align: center;
            font-weight: bold;
            z-index: 1;
        }

        .student-info .student-name {
            font-size: 32px;
            color: #1f3761;
            text-align: right;
            margin-right: 34%;
        }

        .student-info .certificate-class {
            margin-top: 2%;
            font-size: 50px;
            color: #1f3761;
        }

        .student-info .year {
            font-size: 50px;
            margin-top: 16.5%;
            color: black;
        }

        .main-page {
            position: relative;
        }

        @media (max-width: 1199.98px) {
            .card-body{
                background-color: #0000ee !important;
            }
            .student-info .student-name {
                font-size: 20px;
            }
            .student-info .certificate-class {
                font-size: 28px;
            }
            .student-info .year {
                font-size: 28px;
                margin-top: 17.5%;
            }
        }

        @media (max-width: 991.98px) {
            .card-body{
                background-color: #00ff00 !important;
            }
            .student-info .student-name {
                font-size: 20px;
            }
            .student-info .certificate-class {
                font-size: 28px;
            }
            .student-info .year {
                font-size: 28px;
                margin-top: 17.5%;
            }
        }


        @media (max-width: 767.98px){
            .card-body{
                background-color: #00ffff !important;
            }
            .student-info .student-name {
                font-size: 20px;
            }
            .student-info .certificate-class {
                font-size: 28px;
            }
            .student-info .year {
                font-size: 28px;
                margin-top: 17.5%;
            }
        }

        @media (max-width: 575.98px){
            .card-body{
                background-color: #e7515a !important;
            }
            .student-info .student-name {
                font-size: 13px;
            }
            .student-info .certificate-class {
                font-size: 18px;
            }
            .student-info .year {
                font-size: 20px;
                margin-top: 17.5%;
            }
        }




    </style>
@endpush

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


                        @isset($certificate)
                            <div class="content position-relative">

                                <div class="main-page">
                                    <div class="student-info">
                                        <p class="mb-0 student-name">  {{ $studentClass->student->name }}</p>
                                        <p class="mb-0 certificate-class">  {{ $certificate->class }}</p>
                                        <p class="mb-0 year">  {{ $adminActiveAcademicYear->name }}</p>
                                    </div>
                                    <img src="{{ asset('assets/img/certificate_bg.jpg') }}" class="w-100" alt="image">
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered ">
                                        <thead>
                                        <tr>
                                            <th class="fw-bold rounded-0" style="width: 40%" scope="col">المجال و مخرجات
                                                التعلم
                                            </th>
                                            <th class="text-center fw-bold rounded-0" style="width: 30%" scope="col"
                                                colspan="3">
                                                علامة الفصل الاول
                                            </th>
                                            <th class="text-center fw-bold rounded-0" style="width: 30%" scope="col"
                                                colspan="3">
                                                علامة الفصل الثاني
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-center fw-bold rounded-0 px-0" scope="col"></th>
                                            <th class="text-center fw-bold rounded-0 px-0" scope="col">دائماً</th>
                                            <th class="text-center fw-bold rounded-0 px-0" scope="col">أحياناً</th>
                                            <th class="text-center fw-bold rounded-0 px-0" scope="col">نادراً</th>
                                            <th class="text-center fw-bold rounded-0 px-0" scope="col">دائماً</th>
                                            <th class="text-center fw-bold rounded-0 px-0" scope="col">أحياناً</th>
                                            <th class="text-center fw-bold rounded-0 px-0" scope="col">نادرا</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($certificate->fields ?? [] as $field)
                                            <tr class="table-primary text-center fw-bold">
                                                <td colspan="9"><strong>{{ $field->field_name }}</strong></td>
                                            </tr>
                                            @if(count($field->categories) > 0)
                                                @foreach($field->mainCategories as $category)
                                                    <tr class="{{count($category->subcategories) > 0 ? 'table-warning' : ''}}">
                                                        <td style="white-space: pre-wrap">{{ $category->name }}</td>

                                                        <td class="text-center py-0 px-0">
                                                            @if(isset($marks['first'][$category->id]) && $marks['first'][$category->id]['mark'] == "Always")
                                                                <i class="fa fa-check fa-2x"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center py-0 px-0">
                                                            @if(isset($marks['first'][$category->id]) && $marks['first'][$category->id]['mark'] == "Sometimes")
                                                                <i class="fa fa-check fa-2x"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center py-0 px-0">
                                                            @if(isset($marks['first'][$category->id]) && $marks['first'][$category->id]['mark'] == "Rarely")
                                                                <i class="fa fa-check fa-2x"></i>
                                                            @endif
                                                        </td>

                                                        <td class="text-center py-0 px-0">
                                                            @if(isset($marks['second'][$category->id]) && $marks['second'][$category->id]['mark'] == "Always")
                                                                <i class="fa fa-check fa-2x"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center py-0 px-0">
                                                            @if(isset($marks['second'][$category->id]) && $marks['second'][$category->id]['mark'] == "Sometimes")
                                                                <i class="fa fa-check fa-2x"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center py-0 px-0">
                                                            @if(isset($marks['second'][$category->id]) && $marks['second'][$category->id]['mark'] == "Rarely")
                                                                <i class="fa fa-check fa-2x"></i>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @if($category->subcategories->isNotEmpty())
                                                        @foreach($category->subcategories as $subcategory)
                                                            <tr>
                                                                <td style="white-space: pre-wrap">{{ $subcategory->name }}</td>

                                                                <td class="text-center py-0 px-0">
                                                                    @if(isset($marks['first'][$subcategory->id]) && $marks['first'][$subcategory->id]['mark'] == "Always")
                                                                        <i class="fa fa-check fa-2x"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center py-0 px-0">
                                                                    @if(isset($marks['first'][$subcategory->id]) && $marks['first'][$subcategory->id]['mark'] == "Sometimes")
                                                                        <i class="fa fa-check fa-2x"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center py-0 px-0">
                                                                    @if(isset($marks['first'][$subcategory->id]) && $marks['first'][$subcategory->id]['mark'] == "Rarely")
                                                                        <i class="fa fa-check fa-2x"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center py-0 px-0">
                                                                    @if(isset($marks['second'][$subcategory->id]) && $marks['second'][$subcategory->id]['mark'] == "Always")
                                                                        <i class="fa fa-check fa-2x"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center py-0 px-0">
                                                                    @if(isset($marks['second'][$subcategory->id]) && $marks['second'][$subcategory->id]['mark'] == "Sometimes")
                                                                        <i class="fa fa-check fa-2x"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center py-0 px-0">
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

                                    <div class="row px-3 g-0" style="page-break-inside:avoid">
                                        <div class="col-12">
                                            <div class="mb-3 mt-3">
                                                <p class="fs-6  text-black">ملاحظات مربية الفصل الدراسي الاول</p>
                                                <p class="fs-6">{{$studentCertificate->first_notes ?? ''}}</p>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3 h4 mt-5">
                                                <p class="fs-6 text-black">ملاحظات مربية الفصل الدراسي الثاني</p>
                                                <p class="fs-6">   {{$studentCertificate->second_notes ?? ''}}</p>
                                            </div>
                                        </div>

                                        <div class="col-12 border-bottom my-4"></div>
                                        <div class="col-4 text-center">
                                            <p class="h6">توقيع المربية</p>
                                        </div>
                                        <div class="col-4 text-center">
                                            <p class="h6">توقيع الأهل </p>
                                        </div>
                                        <div class="col-4 text-center">
                                            <p class="h6"> الادارة العامة لرياض المجد الأهلية
                                                <br>أ.يسري رياض العيساوي
                                            </p>
                                        </div>


                                        <div class="col-6 mt-3">
                                            <p class="fw-bolder h6">
                                                026654099 – 0522222553
                                            </p>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <p class="fw-bolder text-end text-end h6">
                                                RiadaIm2011@gmail.com
                                            </p>
                                        </div>
                                    </div>


                                </div>

                                <div class="last-page">
                                    <img src="{{ asset('assets/img/certificate_last_page.jpg') }}" class="w-100" alt="image">
                                </div>
                            </div>
                        @else
                           <div class="text-center my-5">
                               <h1>الطالب غير مسجل!</h1>
                           </div>
                        @endisset
                    </div>

                </div>
            </div>

        </div>
    </div>


@endsection
