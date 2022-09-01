<?php

namespace App\Http\Controllers;

use App\Models\EventRegistration;
use App\Models\UserEventRegistration;
use Illuminate\Http\Request;

class UserEventRegistrationsController extends Controller
{
    public function store(Request $request, EventRegistration $event)
    {
        UserEventRegistration::create([
            'user_id' => $request->user()->id,
            'event_registration_id' => $event->id,
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request, EventRegistration $event)
    {
        UserEventRegistration::where([
            'user_id' => $request->user()->id,
            'event_registration_id' => $event->id,
        ])->delete();

        return redirect()->back();
    }
}
