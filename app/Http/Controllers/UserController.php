<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\UpdateUserProfile;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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


    public function profile()
    {

        $data = [
            'user' => auth()->user(),
        ];

        return view('users.profile', $data);
    }

    public function profileUpdate(UpdateUserProfile $request)
    {
        $userData = $request->except(['password']);
        auth()->user()->update($userData);
        Session::flash('message', 'تم تعديل البيانات الشخصية بنجاح.');
        return redirect()->route('profile.edit');
    }

    public function passwordUpdate(Request $request)
    {


        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);


        auth()->user()->update(['password'=> Hash::make($request->new_password)]);
        Session::flash('message', 'تم تعديل كلمة المرور  بنجاح.');
        return redirect()->route('profile.edit');
    }

}
