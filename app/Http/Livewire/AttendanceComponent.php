<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Attendance;

class AttendanceComponent extends Component
{
    public $teacherId;
    public $location;
    public $checkInTime;
    public $checkOutTime;

    public function mount()
    {
        $this->teacherId = auth()->user()->id;

        $attendance = Attendance::where('teacher_id', $this->teacherId)
            ->where('date', now()->toDateString())
            ->where('check_in', '!=', null)
            ->where('check_out', '=', null)
            ->first();

        $this->checkInTime = $attendance?->check_in;
    }

    public function checkIn()
    {

/*        $allowedIp = '192.168.1.1';
        if (request()->ip() !== $allowedIp) {
            return false;
        }*/

        $attendance = Attendance::create([
            'teacher_id' => $this->teacherId,
            'date' => now()->toDateString(),
            'check_in' => now()->toTimeString(),
            'check_in_location' => $this->location,
            'status' => 'present',
        ]);

        $this->checkInTime = $attendance->check_in;
    }

    public function checkOut()
    {

        $attendance = Attendance::where('teacher_id', $this->teacherId)
            ->where('date', now()->toDateString())
            ->where('check_in', '!=', null)
            ->where('check_out', '=', null)
            ->first();

        if ($attendance) {
            $checkInTime = Carbon::parse($attendance->check_in);
            $checkOutTime = Carbon::now();
            $totalHours = $checkOutTime->diffInMinutes($checkInTime) / 60;

            $attendance->update([
                'check_out' => now()->toTimeString(),
                'check_out_location' => $this->location,
                'total_hours' => round($totalHours, 2),
            ]);

            $this->checkInTime = null;
        } else {
            session()->flash('error', 'Check-in required first!');
        }
    }

    public function render()
    {
        return view('livewire.attendance-component');
    }
}
