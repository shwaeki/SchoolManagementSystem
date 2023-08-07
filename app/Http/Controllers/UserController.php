<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }


    public function create()
    {

        $data = [
            'roles' => Role::pluck('name', 'id'),
        ];

        return view('users.create', $data);
    }


    public function store(StoreUserRequest $request)
    {
        $userData = $request->except(['role']);
        $user = User::create($userData);
        $user->assignRole($request->role);
        Session::flash('message', 'تم اضافة مستخدم جديد بنجاح.');
        return redirect()->route('users.index');
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        $data = [
            'user' => $user,
            'roles' => Role::pluck('name', 'id'),
        ];

        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $userData = $request->except(['role']);
        $user->update($userData);
        $user->syncRoles($request->role);
        Session::flash('message', 'تم تحديث معلومات المستخدم  بنجاح.');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id == Auth::user()->id || $user->id == 1) {
            Session::flash('message', 'لا يمكنك حذف هذا المستخدم.');
            return back();
        }
        $user->delete();
        Session::flash('message', 'تم حذف المستحدم بنجاح.');
        return redirect()->route('users.index');
    }
}
