<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->update($request->all());
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
