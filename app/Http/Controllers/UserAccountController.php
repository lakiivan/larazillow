<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia('UserAccount/UserAccountCreate');
    }

    public function store(Request $request)
    {
        $user = User::create($request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',
        ]));

        FacadesAuth::login($user);

        return redirect()->route('listing.index')->with('success', 'Account Created!');
    }
}
