<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
       $users =  User::all();

        return view('users.index',['users' => $users]);
    }

    public function edit(User $user)
    {
     return view('users.form', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
    }

    public function update(User $user , StoreUserRequest $request)
    {
        $attributes = $request->all();

        $user->update($attributes);

        return redirect()->back();
    }

    public function ban(User $user)
    {
        $this->authorize('ban', $user);

        $user->update(['is_banned'=> true]);

        return redirect()->back();
    }

    public function unban(User $user)
    {
        $this->authorize('unban', $user);

        $user->update(['is_banned'=> false]);

        return redirect()->back();
    }

}
