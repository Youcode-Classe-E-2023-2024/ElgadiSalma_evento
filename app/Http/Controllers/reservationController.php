<?php

namespace App\Http\Controllers;

use App\Mail\reservationMail;
use Illuminate\Http\Request;
use App\Models\Event;
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

    $pdf = PDF::loadView('Events.ticket', compact('reservation','event'));
    $pdfPath = storage_path('app/public/temp/ticket_' . $reservation->id . '.pdf');
    $pdf->save($pdfPath);

    Mail::to($request->input('email'))->send(new ReservationMail($pdfPath));

    return redirect()->route('event.view')->with('success', 'Evenement bien ajoutée.');
}
}
