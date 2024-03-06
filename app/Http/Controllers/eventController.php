<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Lieu;
use App\Models\Category;
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
        ]);

        foreach ($request->file('image') as $file) {
            $storedFile = $file->store('uploads');

            $media = $event->addMedia(storage_path('app/' . $storedFile))->toMediaCollection();

            $event->id_image = $media->id;
            $event->save();
        }

        return redirect()->route('addEvent.view')->with('success', 'Evenement bien ajoutée.');
    }
    

}