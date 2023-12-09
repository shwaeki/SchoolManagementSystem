<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\YearClass;
use App\Http\Requests\StoreYearClassRequest;
use App\Http\Requests\UpdateYearClassRequest;
use Illuminate\Support\Facades\Session;
use function Psy\debug;

class YearClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreYearClassRequest $request)
    {
        $data = request()->all() + ['added_by' => auth()->id()];
        YearClass::create($data);
        Session::flash('message', 'تم اضافة فصل التعليمي جديد بنجاح.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(YearClass $yearClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(YearClass $yearClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateYearClassRequest $request, YearClass $yearClass)
    {

        $yearClass->update(request()->all());
        Session::flash('message', 'تم تعديل معلومات الفصل التعليمي بنجاح.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(YearClass $yearClass)
    {
        //
    }
}
