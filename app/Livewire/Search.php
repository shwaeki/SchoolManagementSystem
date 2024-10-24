<?php

namespace App\Livewire;

use App\Models\Student;
use App\Models\StudentRequest;
use App\Models\Teacher;
use Livewire\Attributes\On;
use Livewire\Component;

class Search extends Component
{
    public $searchStatus = true;
    public $query;
    public $data;

    public function mount()
    {
        $this->resetAll();
    }

    public function resetAll()
    {
        $this->searchStatus = false;
        $this->query = '';
        $this->data['students'] = [];
        $this->data['students-request'] = [];
        $this->data['teachers'] = [];
    }

    #[On('changeStatus')]
    function changeStatus($status)
    {
        $this->searchStatus = $status;
    }

    public function updatedQuery()
    {
        if (strlen($this->query) >= 3) {
            $students = Student::where(function ($q) {
                $q->where('name', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('identification', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('mother_phone', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('father_phone', 'LIKE', '%' . $this->query . '%');
            })->get()->toArray();

            $studentsRequests = StudentRequest::where(function ($q) {
                $q->where('name', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('identification', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('mother_phone', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('father_phone', 'LIKE', '%' . $this->query . '%');
            })->get()->toArray();


            $teachers = Teacher::where(function ($q) {
                $q->where('name', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('identification', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('phone', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('phone_2', 'LIKE', '%' . $this->query . '%');
            })->get()->toArray();

            $this->data['students'] = $students;
            $this->data['students-request'] = $studentsRequests;
            $this->data['teachers'] = $teachers;
        }
    }

    public function searchForm()
    {
        //  return redirect()->route('search',['q'=> $this->query]);
        return '';
    }


    public function render()
    {
        return view('livewire.search');
    }
}
