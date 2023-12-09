<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequestRequest;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentRequest;
use App\Notifications\NewStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'schools' => SchoolClass::all(),
        ];
        return view('application.create',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function message()
    {
        return view('application.message');
    }

    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequestRequest $request)
    {
        $data = request()->all();

        $date = str_replace('/', '-', request('birth_date'));
        $data['birth_date'] = date('Y-m-d', strtotime($date));
        $studentRequest = StudentRequest::create($data);

        if ($request->hasFile('personal_photo')) {
            $extension = $request->file('personal_photo')->getClientOriginalExtension();
            $fileNameToStore = "الصورة الشخصية" . '.' . $extension;
            $request->file('personal_photo')->storeAs("public/files/StudentRequest_" . $studentRequest->id, $fileNameToStore);
        }

        if ($request->hasFile('birth_certificate')) {
            $extension = $request->file('birth_certificate')->getClientOriginalExtension();
            $fileNameToStore = "شهادة الميلاد " . '.' . $extension;
            $request->file('birth_certificate')->storeAs("public/files/StudentRequest_" . $studentRequest->id, $fileNameToStore);
        }

        Notification::route('mail', ['riadalm2011@gmail.com', 'shwaeki98@gmail.com', 'suppwithyou@gmail.com'])->notify(new NewStudentRequest($studentRequest));

        return redirect()->route("application.message");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
