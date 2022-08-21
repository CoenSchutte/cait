<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->update($request->all());
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = auth()->user();
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Het wachtwoord komt niet overeen met het huidige wachtwoord");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $request->session()->forget('password_hash_web');
        Auth::guard('web')->login($user);
        return back()->with("status", "Het wachtwoord is succesvol gewijzigd");
    }
}
