<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class reservationController extends Controller
{
    public function reserverEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idEvent' => 'required',
            'acceptation' =>'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        $status = $request->input('acceptation') == '1' ? '0' : '1';

        $event = Reservation::create([
            'event_id' => $request->input('idEvent'),
            'user_id' => $user->id, 
            'email' => $request->input('email'),
            'status' => $status,
        ]);

        return redirect()->route('event.view')->with('success', 'Evenement bien ajoutée.');
    
    }   
}
