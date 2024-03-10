<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Lieu;
use App\Models\User;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class eventController extends Controller
{
    public function addEventView()
    {
        $cities = Lieu::all();
        $categories = Category::all();  
        return view('Events.addEvent', compact('cities','categories'));
    }

    public function addEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'place' => 'required',
            'lieu' => 'required',
            'category' => 'required',
            'image' =>'required',
            'deadline' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // dd($request);
        $user = Auth::user();
        $acceptation = $request->has('validation') ? 1 : 0;

        $event = Event::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'id_image' => $request->input('image'),
            'nombre_place' => $request->input('place'),
            'ville_id' => $request->input('lieu'),
            'category_id' => $request->input('category'),
            'deadline' => $request->input('deadline'),
            'created_by' => $user->id,
            'acceptation' => $acceptation,
        ]);

        foreach ($request->file('image') as $file) {
            $storedFile = $file->store('uploads');

            $media = $event->addMedia(storage_path('app/' . $storedFile))->toMediaCollection();

            $event->id_image = $media->id;
            $event->save();
        }

        return redirect()->route('addEvent.view')->with('success', 'Evenement bien ajoutée.');
    }
    public function eventView()
    {        
        $categories = Category::all();

        $events = Event::with('category', 'city', 'createdBy')->where('status', 1)->get();
        // dd($events->);
        return view('Events.events', compact('events','categories'));
    }

    public function getEventById($id)
    {
        $event = Event::with('category', 'city', 'createdBy')->find($id);
        $reservationsCount = Reservation::where('event_id', $id)->where('status', 1)->count();
        $placesMax = $event->nombre_place;
        if ($reservationsCount >= $placesMax) {
            $placesRestantes = 0;
        }else
        {
            $placesRestantes = 1;
        }

        // stats
        $reservationStatistics = Reservation::where('event_id', $id)
        ->where('status', 1)
        ->selectRaw('date(created_at) as date, count(*) as reservation_count')
        ->groupBy('date')
        ->get();


        $reservateurId = Reservation::where('event_id', $id)->where('status', 0)->pluck('user_id');

        $reservateurs = User::whereIn('id', $reservateurId)->get();

        // dd($reservateurs);
        return view('Events.details', compact('event','placesRestantes','reservateurs', 'reservationStatistics'));
    }

    public function myEventView()
    {
        $me = Auth::user();
        $events = Event::with('category', 'city', 'createdBy')->where('status', 1)->where('created_by', $me->id)->get();
        $categories = Category::all();
        // dd($events->);
        return view('Events.myEvents', compact('events','categories'));
    }
    public function searchMyEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'query' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('myEvent.view');
        }

        $query = $request->input('query');

        $categories = Category::all();

        $me = Auth::user();

        $events = Event::where('title', 'like', '%' . $query . '%')->where('created_by', $me->id)->get();

        return view('Events.myEvents', compact('events','categories'));
    }

    public function searchEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'query' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('event.view');
        }

        $query = $request->input('query');

        $categories = Category::all();

        $me = Auth::user();

        $events = Event::where('title', 'like', '%' . $query . '%')->where('created_by', $me->id)->get();

        return view('Events.events', compact('events','categories'));
    }

    public function filterMyEvent(Request $request)
    {
        $categoryId = $request->input('category');
        $me = Auth::user();
        $categories = Category::all();

        if ($categoryId == 'all') {
            $events = Event::all();
        } else {
            $events = Event::where('category_id', $categoryId)->where('created_by', $me->id)->get();
        }

        return view('Events.myEvents', compact('events','categories'));
    }

    public function filterEvent(Request $request)
    {
        $categoryId = $request->input('category');
        $me = Auth::user();
        $categories = Category::all();

        if ($categoryId == 'all') {
            $events = Event::all();
        } else {
            $events = Event::where('category_id', $categoryId)->where('created_by', $me->id)->get();
        }

        return view('Events.events', compact('events','categories'));
    }

    public function deleteEvent(Request $request)
    {
        $me = Auth::user();
        $request->validate([
            'eventId' => 'required',
        ]);

        $eventId = $request->input('eventId');
        Event::where('id', $eventId)->where('created_by', $me->id)->delete();

        return back()->with('success', 'Levent est supprieme ');

    }

    public function editView($id)
    {
        $categories = Category::all();
        $cities = Lieu::all();
        $event = Event::with('category', 'city', 'createdBy')->find($id);
        $me = Auth::user();

        if($event->created_by == $me->id){
        return view('Events.edit', compact('event','categories', 'cities'));
        }
        else{
            abort('404');
        }
    }

    public function editEvent(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'place' => 'required',
            'lieu' => 'required',
            'category' => 'required',
            'deadline' => 'required',
        ]);
        // dd($validator);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $event = Event::findOrFail($id);
    
        $acceptation = $request->has('validation') ? 1 : 0;
    
        $event->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'nombre_place' => $request->input('place'),
            'ville_id' => $request->input('lieu'),
            'category_id' => $request->input('category'),
            'deadline' => $request->input('deadline'),
            'acceptation' => $acceptation,
        ]);
    
        return redirect()->route('myEvent.view')->with('success', 'Événement mis à jour avec succès.');
    }
    
    /*
    |--------------------------------------------------------------------------
    |  Admin
    |--------------------------------------------------------------------------
    */

    public function adminEventView()
    {
        $events = Event::with('category', 'city', 'createdBy')
        ->where('status', 0)
        ->get();        // dd($events->);
        return view('Admin.event', compact('events'));    
    }

    public function approuveEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->update(['status' => 1]);

        return redirect()->route('adminEvent.view')->with('success', 'Evenement bien ajoutée.');
    }
    public function desapprouveEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('adminEvent.view')->with('success', 'Evenement bien ajoutée.');
    }
}
