<?php

namespace App\Http\Controllers;

use App\Models\CertificateField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CertificateFieldController extends Controller
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
            'field_name' => 'required|string|max:255',
        ]);

        CertificateField::create(request()->all());
        Session::flash('message', 'تم اضافة مجال جديد بنجاح.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CertificateField $certificateField)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CertificateField $certificateField)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCertificateFieldRequest $request, CertificateField $certificateField)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CertificateField $certificateField)
    {
        //
    }

    public function getCategories()
    {
        $field_id = request('field_id');
        if (!$field_id) {
            return response()->json(['result' => false]);
        }

        $field = CertificateField::findOrFail($field_id);
        $fieldMainCategories = $field->mainCategories;

        return response()->json(['result' => true, 'data' => $fieldMainCategories]);
    }
}
