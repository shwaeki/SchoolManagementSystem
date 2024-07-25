@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <h4> تقاريري الخاصة </h4>
        </div>
        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الاسم</th>
                        <th scope="col">تاريخ الاضافة</th>
                        <th scope="col">خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$report->name}}</td>
                            <td>{{$report->created_at->format('Y-m-d')}}</td>
                            <td>
                                <a target="_blank"
                                   href="{{route('teacher-reports.show',['teacher_report'=>$report])}}"
                                   type="button" class="btn btn-delete">
                                    عرض
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
