<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Tables\Users;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\Splade\Facades\Splade;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Users::class;

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create', [
            'roles' => Role::pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::create($data);
        $user->assignRole($request['role']);

        Splade::toast('User create successfully')->autoDismiss(3);

        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        return view('admin.user.edit', [
            'roles' => Role::pluck('name', 'id')->toArray(),
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        $role = $request->validate([
            'roles' => ['required']
        ]);

        $user->syncRoles($role);

        Splade::toast('User update successfully')->autoDismiss(3);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        $user->delete();

        Splade::toast('User delete successfully')->autoDismiss(3);

        return back();
    }
}
