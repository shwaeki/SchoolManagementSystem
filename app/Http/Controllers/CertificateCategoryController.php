<?php

namespace App\Http\Controllers;

use App\Models\CertificateCategory;
use App\Http\Requests\StoreCertificateCategoryRequest;
use App\Http\Requests\UpdateCertificateCategoryRequest;
use App\Models\CertificateField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CertificateCategoryController extends Controller
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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        CertificateCategory::create(request()->all());
        Session::flash('message', 'تم اضافة  بنجاح.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CertificateCategory $certificateCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CertificateCategory $certificateCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CertificateCategory $certificateCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);


        $certificateCategory->update(['name' => request('name')]);
        Session::flash('message', 'تم التحديث  بنجاح.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CertificateCategory $certificateCategory)
    {
        $certificateCategory->delete();
        Session::flash('message', 'تم الحذف  بنجاح.');
        return redirect()->back();
    }
}
