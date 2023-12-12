@extends('layouts.app')

@push('styles')
    <style>

        @media print {


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
        }


        @page {
            size: A4 portrait;
            margin: 0.0cm;
        }


    </style>
@endpush

@section('content')

    <div class="container-fluid p-0 bg-white">

        <table class="table table-sm table-bordered">
            <thead>
            <tr>
                <th scope="col">المجال</th>
                <th scope="col">علامة الفصل الاول</th>
                <th scope="col">علامة الفصل الثاني</th>
            </tr>
            </thead>
            <tbody>
            @foreach($certificate->fields as $field)
                @foreach($certificate->fields as $field)
                    <tr class="table-primary text-center fw-bold">
                        <td colspan="3"><strong>{{ $field->field_name }}</strong></td>

                    </tr>
                    @if(count($field->categories) > 0)
                        @foreach($field->mainCategories as $category)
                            <tr class="{{count($category->subcategories) > 0 ? 'table-warning' : ''}}">
                                <td>{{ $category->name }}</td>
                                <td>

                                    @isset($marks['first'][$category->id])
                                        {{  trans('options.'.$marks['first'][$category->id]['mark']) }}
                                    @endisset
                                </td>
                                <td>
                                    @isset($marks['second'][$category->id])
                                        {{  trans('options.'.$marks['second'][$category->id]['mark']) }}
                                    @endisset
                                </td>
                            </tr>
                            @if($category->subcategories->isNotEmpty())
                                @foreach($category->subcategories as $subcategory)
                                    <tr>
                                        <td>{{ $subcategory->name }}</td>
                                        <td>
                                            @isset($marks['first'][$subcategory->id])
                                                {{  trans('options.'.$marks['first'][$subcategory->id]['mark']) }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset($marks['second'][$subcategory->id])
                                                {{  trans('options.'.$marks['second'][$subcategory->id]['mark']) }}
                                            @endisset
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>


    </div>

@endsection
