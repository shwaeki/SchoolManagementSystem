@extends('layouts.app')

@push('styles')
    <style>
        html{
            height: 100%;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transform-origin: 0 0;
            opacity: 0.2;
        }

        .watermark img {
            height: 430px;
            width: 430px;
        }

        .student-info {
            position: absolute;
            top: 71.2%;
            width: 100%;
            text-align: center;
            padding-right: 150px;
            font-weight: bold;
            z-index: 1;
            line-height: 57px;
        }

        .student-info p {
            font-size: 20px;
            color: black;
        }

        .student-info .student-name {
            margin-right: 150px;
        }

        .main-page {
            position: relative;
        }

        .table:not(.dataTable).table-bordered > tbody > tr:last-child td:last-child {
            border-bottom-left-radius: 0;
        }

        .table:not(.dataTable).table-bordered > tbody > tr:last-child td:first-child {
            border-bottom-right-radius: 0;
        }

        body {
            background-color: white;

        }
        @media print {
            .layout-top-spacing {
                margin-top: 0 !important;
            }

            html, body {
                width: 210mm;
                height: 297mm;
            }



            .sidebar-wrapper {
                display: none;
            }

            .header-container {
                display: none;
            }

            #content {
                margin-top: 0;
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

            .last-page {
                page-break-before: always;
                width: 100vw;
                height: 100vh;
                position: relative;
            }

            .last-page img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
            }

            .student-info p {
                font-size: 12px;
                line-height: 30px;
            }

            .student-info .student-name {
                margin-right: 25px;
            }

        }

        @page {
            size: A4 portrait;
            margin: 0mm !important;
        }


    </style>
@endpush

@section('content')
    <div class="watermark">
        <img src="{{ asset('assets/img/watermark.png') }}" alt="watermark">
    </div>

    <div class="content position-relative">

        <div class="main-page">
            <div class="student-info">

                <p class="mb-0 student-name">  {{ $studentClass->student->name }}</p>
                <p class="mb-0">  {{ $certificate->age }}</p>
                <p class="mb-0">  {{ $certificate->class }}</p>
            </div>
            <img src="{{ asset('assets/img/certificate_bg.jpg') }}" class="w-100" alt="image">
        </div>

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

            <div class="row px-3 g-0" style="page-break-before:avoid">
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
            </div>


        </div>

        <div class="last-page">
            <img src="{{ asset('assets/img/certificate_last_page.jpg') }}" class="w-100" alt="image">
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        window.onafterprint = window.close;
        window.print();
    </script>
@endpush
