<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionsDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view-permission');
        $this->middleware('permission:create-permission', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-permission', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-permission', ['only' => ['destroy']]);
    }


    public function index(PermissionsDataTable $dataTable)
    {
        return $dataTable->render('permissions.index');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:permissions|max:255',
            'display_name' => 'required|max:255',
        ]);

        Permission::create(['name' => $request->name, 'display_name' => $request->display_name]);

        Session::flash('message', 'تم اضافة صلاحية جديد بنجاح.');
        return redirect()->route('permissions.index');
    }

    public function create()
    {

        return view('permissions.create');
    }

    public function show(Permission $permission)
    {
        //
    }


    public function edit(Permission $permission)
    {
        $data = [
            'permission' => $permission,
        ];

        return view('permissions.edit', $data);
    }


    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|max:255|unique:permissions,name,' . $permission->id,
            'display_name' => 'required|max:255',
        ]);

        $permission->update(['name' => $request->name, 'display_name' => $request->display_name]);
        Session::flash('message', 'تم تحديث معلومات الصلاحية  بنجاح.');
        return redirect()->route('permissions.index');
    }


    public function destroy(Permission $permission)
    {
        $permission->delete();
        Session::flash('message', 'تم حذف الصلاحية بنجاح.');
        return redirect()->route('users.index');
    }
}
