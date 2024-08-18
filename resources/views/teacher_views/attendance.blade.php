@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <h4>تقارير الحضور</h4>
        </div>
        <div class="widget-content widget-content-area">
            <form class="px-3">
                <div class="mb-3">
                    <label for="date" class="form-label">التاريخ</label>
                    <input type="date" class="form-control" id="date" name="date" onchange="this.form.submit()"
                           value="{{old('date',Carbon\Carbon::now()->toDateString())}}">
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="rounded-0" scope="col">#</th>
                        <th scope="col">التاريخ</th>
                        <th scope="col"> وقت الدخول</th>
                        <th scope="col">وقت الخروج</th>
                        <th class="rounded-0" scope="col"> عدد الساعات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attendances as $attendance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$attendance->date}}</td>
                            <td>{{$attendance->check_in}}</td>
                            <td>{{$attendance->check_out}}</td>
                            <td>{{$attendance->total_hours}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
