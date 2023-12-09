<?php

namespace App\Http\Controllers;

use App\DataTables\CertificatesDataTable;
use App\DataTables\RolesDataTable;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CertificateController extends Controller
{

    public function index(CertificatesDataTable $dataTable)
    {
        return $dataTable->render('certificates.index');
    }

    public function create()
    {
        return view('certificates.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Certificate::create(request()->all());
        Session::flash('message', 'تم اضافة شهادة جديد بنجاح.');

        return redirect()->route('certificates.index');
    }

    public function show(Certificate $certificate)
    {
        $certificate->load('fields.categories.subcategories', 'fields.mainCategories.subcategories');

        $data = [
            'certificate' => $certificate,
        ];

        return view('certificates.show', $data);
    }

    public function edit(Certificate $certificate)
    {
        return view('certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $certificate->update(request()->all());
        Session::flash('message', 'تم تحديث معلومات الشهادة بنجاح.');

        return redirect()->route('certificates.index');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('certificates.index');
    }
}
