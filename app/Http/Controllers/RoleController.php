<?php

namespace App\Http\Controllers;

use App\DataTables\RolesDataTable;
use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

/*    public function __construct()
    {
        $this->middleware('permission:view-role');
        $this->middleware('permission:create-role', ['only' => ['create','store']]);
        $this->middleware('permission:update-role', ['only' => ['edit','update']]);
        $this->middleware('permission:destroy-role', ['only' => ['destroy']]);
    }*/


    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('roles.index');
    }


    public function create()
    {
        $data = [
            'permissions' => Permission::pluck('name', 'id'),
        ];

        return view('roles.create', $data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        Session::flash('message', 'تم اضافة دور جديد بنجاح.');
        return redirect()->route('roles.index');
    }


    public function show(Role $role)
    {
        //
    }


    public function edit(Role $role)
    {
        $data = [
            'role' => $role,
            'permissions' => Permission::pluck('name', 'id'),
        ];

        return view('roles.edit', $data);
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|max:255|unique:roles,name,'.$role->id,
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        Session::flash('message', 'تم تحديث معلومات الدور  بنجاح.');
        return redirect()->route('roles.index');
    }


    public function destroy(Role $role)
    {
        if ($role->id == 1 || $role->name == 'super-admin') {
            Session::flash('message', 'لا يمكنك حذف هذا الدور!.');
            return back();
        }
        $role->delete();
        Session::flash('message', 'تم حذف الدور بنجاح.');
        return redirect()->route('users.index');
    }
}
