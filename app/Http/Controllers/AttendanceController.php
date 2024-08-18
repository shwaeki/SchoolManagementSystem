<?php

namespace App\Http\Controllers;

use App\DataTables\AttendancesDataTable;
use App\Models\Attendance;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller
{
    public function index(AttendancesDataTable $dataTable)
    {
        $data = [
            'teachers' => Teacher::where('archived', 0)->get(),
        ];

        return $dataTable->render('attendances.index',$data);
    }

    public function store(StoreAttendanceRequest $request)
    {
        $data = request()->all();
        $checkInTime = Carbon::parse($data['check_in']);
        $checkOutTime = Carbon::now();
        $totalHours = $checkOutTime->diffInMinutes($checkInTime) / 60;

        $data['check_in_location'] = 'Add Manually By: '.auth()->user()->name;
        $data['check_out_location'] = 'Add Manually By: '.auth()->user()->name;
        $data['total_hours'] = $totalHours;
        Attendance::create($data);

        Session::flash('message', 'تم تسجيل الحضور بنجاح.');
        return redirect()->back();
    }


    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $data = request()->all();
        $checkInTime = Carbon::parse($data['check_in']);
        $checkOutTime = Carbon::now();
        $totalHours = $checkOutTime->diffInMinutes($checkInTime) / 60;

        $data['total_hours'] = $totalHours;
        $attendance->update($data);
        Session::flash('message', 'تم تعديل الحضور بنجاح.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
