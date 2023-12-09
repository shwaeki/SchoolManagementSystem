<?php

namespace App\Http\Controllers;

use App\Models\StudentMark;
use Illuminate\Http\Request;

class StudentMarkController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      dd(\request()->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentMark $studentMark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentMark $studentMark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentMark $studentMark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentMark $studentMark)
    {
        //
    }
}
