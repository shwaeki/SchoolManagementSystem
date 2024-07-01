<?php

namespace App\Http\Controllers;

use App\DataTables\AdvertisesDataTable;
use App\Models\Advertise;
use App\Http\Requests\StoreAdvertiseRequest;
use App\Http\Requests\UpdateAdvertiseRequest;
use Illuminate\Support\Facades\Session;

class AdvertiseController extends Controller
{
    public function index(AdvertisesDataTable $dataTable)
    {
        return $dataTable->render('advertises.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('advertises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdvertiseRequest $request)
    {
        $all_data = request()->all();

        $data = $all_data + ['added_by' => auth()->id(),];
        Advertise::create($data);

        Session::flash('message', 'تم اضافة اعلان جديد بنجاح.');
        return redirect()->route('advertises.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertise $advertise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advertise $advertise)
    {
        $data = [
            'advertise' => $advertise,
        ];
        return view('advertises.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvertiseRequest $request, Advertise $advertise)
    {
        $addedData = [
            'status' => request()->has('status') ? 1 : 0,
        ];

        $data = request()->all() + $addedData;

        $advertise->update($data);
        Session::flash('message', 'تم تعديل معلومات الاعلان بنجاح.');
        return redirect()->route('advertises.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertise $advertise)
    {
        //
    }
}
