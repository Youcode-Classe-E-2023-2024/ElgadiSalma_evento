<?php

namespace App\Http\Controllers;

use App\Mail\reservationMail;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;

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

        $reservation = Reservation::create([
            'event_id' => $request->input('idEvent'),
            'user_id' => $user->id, 
            'email' => $request->input('email'),
            'status' => $status,
        ]);

        $event = Event::with('category', 'city', 'createdBy')->find($request->input('idEvent'));

        $users = User::find($user);
        // dd($users);

        if($status == 1){
        $pdf = PDF::loadView('Events.ticket', compact('reservation','event','users'));
        $pdfPath = storage_path('app/public/temp/ticket_' . $reservation->id . '.pdf');
        $pdf->save($pdfPath);

        Mail::to($request->input('email'))->send(new ReservationMail($pdfPath));
        }
        return redirect()->route('event.view')->with('success', 'Evenement bien ajoutee.');
    }

    public function approuveReservation(Request $request)
    {
        $request->validate([
            'eventId' => 'required',
            'userId' => 'required',
        ]);
        
        $eventId = $request->input('eventId');
        $userId = $request->input('userId');
        
        $reservation = Reservation::where('event_id', $eventId)->where('user_id', $userId)->first();
    
        if ($reservation) {
            $reservation->status = 1;
            $reservation->save();
    
            return back()->with('success', 'La reservation est approuvee ');
        } else {
            return back()->with('error', 'Aucune reservation correspondante');
        }
    }

    public function desapprouveReservation(Request $request)
    {
        $request->validate([
            'eventId' => 'required',
            'userId' => 'required',
        ]);
        
        $eventId = $request->input('eventId');
        $userId = $request->input('userId');
        
        Reservation::where('event_id', $eventId)->where('user_id', $userId)->delete();
        return back()->with('success', 'La reservation est supprieme ');

    }

}
