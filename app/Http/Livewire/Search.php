<?php

namespace App\Http\Livewire;

use App\Models\Student;
use App\Models\Teacher;
use Livewire\Component;

class Search extends Component
{


    protected $listeners = ['changeStatus'];
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
        $this->data['teachers'] = [];
    }


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


            $teachers = Teacher::where(function ($q) {
                $q->where('name', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('identification', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('phone', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('phone_2', 'LIKE', '%' . $this->query . '%');
            })->get()->toArray();

            $this->data['students'] = $students;
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
