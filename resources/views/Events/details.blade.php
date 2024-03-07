@extends('layout')

@section('content')
@php
use Carbon\Carbon;
@endphp
<!-- component -->
<div class="h-fit my-10 min-h-screen mx-auto">
  
    <main class="mt-5 justify-center">
        
        <div class="flex flex-wrap w-full gap-10 justify-center">
            <div class="flex w-2/3 justify-between">
                <div class="flex gap-2 ">
                    <img src=""
                        class="h-10 w-10 rounded-full object-cover" />
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">{{ $event->user }}</p>
                        <p class="font-semibold text-gray-700 text-xs">{{ Carbon::parse( $event->created_at )->diffForHumans() }}</p>
                    </div>
                </div>
               
                <div class="">
                    <a href="#" class="px-4 py-1 bg-purple-400 text-white inline-flex items-center justify-center ">{{ $event->category->name }}</a>   

                </div>
            </div>
            @foreach ($event->getMedia() as $mediaItem)
            <img class="w-2/3 h-80" src="{{ $mediaItem->getUrl() }}" />
            @endforeach

            <div class="w-2/3 flex flex-col gap-5 text-gray-700">
                
                <h2 class="text-3xl font-semibold text-blue-800">{{ $event->title }}</h2>
            </div>
    
            <div class="flex flex-col w-full items-center justify-center">
            <div class="text-gray-600 w-2/3 text-lg  ">
                <p class="">{{ $event->description }}</p>
            </div>
            </div>
        </div>
          
        </main>
 
  </div>

@endsection
