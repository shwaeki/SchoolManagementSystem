<?php

namespace App\Http\Livewire;

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
    }

    public function checkIn()
    {
        $this->validate([
            'location' => 'required|string',
        ]);

        $allowedIp = '192.168.1.1';
        if (request()->ip() !== $allowedIp) {
            return false;
        }

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
        $this->validate([
            'location' => 'required|string',
        ]);

        $attendance = Attendance::where('teacher_id', $this->teacherId)
            ->where('date', now()->toDateString())
            ->first();

        if ($attendance) {
            $attendance->update([
                'check_out' => now()->toTimeString(),
                'check_out_location' => $this->location,
            ]);

            $this->checkOutTime = $attendance->check_out;
        } else {
            session()->flash('error', 'Check-in required first!');
        }
    }

    public function render()
    {
        return view('livewire.attendance-component');
    }
}
