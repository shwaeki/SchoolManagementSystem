@extends('layouts.app')

@push('styles')
    <style>

        .student-name {
            position: absolute;
            left: 13%;
            top: 61%;
            font-size: 24px;
            color: black;
            font-weight: bold;
            z-index: 1;
        }

        .main-page {
            position: relative;
        }


        @media print {
            .layout-top-spacing {
                margin-top: 0px !important;
            }

            html, body {
                height: 210mm;
                width: 297mm;
            }

            body {
                background-color: white;

            }

            .sidebar-wrapper {
                display: none;
            }

            .header-container {
                display: none;
            }

            #content {
                margin-top: 0px;
            }

            .col-12 {
                padding: 0 !important;
            }

            .main-page {
                page-break-before: always;
                width: 100vw;
                height: 100vh;
            }

            .main-page img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
            }

            .student-name {

                font-size: 16px;
            }
        }

        @page {
            size: A4 landscape;
            margin: 0 !important;
        }


    </style>
@endpush

@section('content')
    <div class="content position-relative">
        <div class="main-page">
            <p class="student-name">  {{ $studentClass->student->name }}</p>
            <img src="https://i.ibb.co/R0nN8bd/Picture1.jpg" class="w-100" alt="image">
        </div>

        <div class="bg-white p-3">
            <table class="table table-sm table-bordered ">
                <thead>
                <tr>
                    <th class="fw-bold" scope="col">المجال و مخرجات التعلم</th>
                    <th class="text-center fw-bold" scope="col" colspan="3">علامة الفصل الاول</th>
                    <th class="text-center fw-bold" scope="col" colspan="3">علامة الفصل الثاني</th>
                </tr>
                <tr>
                    <th class="text-center fw-bold" scope="col"></th>
                    <th class="text-center fw-bold" scope="col">دائماً</th>
                    <th class="text-center fw-bold" scope="col">أحياناً</th>
                    <th class="text-center fw-bold" scope="col">نادراً</th>
                    <th class="text-center fw-bold" scope="col">دائماً</th>
                    <th class="text-center fw-bold" scope="col">أحياناً</th>
                    <th class="text-center fw-bold" scope="col">نادرا</th>
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

            <div class="row px-3">
                <div class="col-12">
                    <div class="mb-3 h4 mt-3">
                        <p>ملاحظات مربية الفصل الدراسي الاول</p>
                        <p>{{$studentCertificate->first_notes}}</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3 h4 mt-3">
                        <p>ملاحظات مربية الفصل الدراسي الثاني</p>
                        <p>   {{$studentCertificate->second_notes}}</p>
                    </div>
                </div>

                <div class="col-12 border-bottom my-4"></div>
                <div class="col-4 text-center">
                    <p class="h5">توقيع المربية</p>
                </div>
                <div class="col-4 text-center">
                    <p class="h5">توقيع الأهل </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h5"> الادارة العامة لرياض المجد الأهلية
                        <br>أ.يسري رياض العيساوي
                    </p>
                </div>
            </div>


        </div>
    </div>
@endsection
