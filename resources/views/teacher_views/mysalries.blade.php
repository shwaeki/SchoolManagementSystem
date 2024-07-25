@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <h4> قسائم الرواتب </h4>
        </div>
        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col"> التاريخ</th>
                        <th scope="col"> خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salaries as $salary)
                        <tr>
                            <td>{{$salary->date}}</td>
                            <td>
                                <a class="btn btn-primary" target="_blank"
                                   href="{{route('show.salary',$salary)}}">
                                    تحميل
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
