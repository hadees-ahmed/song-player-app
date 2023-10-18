<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Mail\UserBanned;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        Mail::to($user)->send(new UserBanned($user));

        $user->update(['banned_at'=> now()]);

        return redirect()->back();
    }

    public function unban(User $user)
    {
        $this->authorize('unban', $user);

        $user->update(['banned_at'=> null]);

        return redirect()->back();
    }
}
