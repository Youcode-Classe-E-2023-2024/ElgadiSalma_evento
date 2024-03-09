@extends('layout')

@section('content')

<div class="py-16 sm:py-24 lg:mx-auto lg:max-w-7xl lg:px-8 min-h-screen">
  <h1 class="text-4xl text-blue-800 pb-16 text-center font-bold">Events</h1>

    <div class="flex flex-wrap justify-center gap-5 w-full px-4 sm:px-6 lg:px-0">

        @forelse($events as $event)

        <div class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
            <h3 class="mb-3 text-xl font-bold text-indigo-600">{{ $event->category->name }}</h3>
            <div class="relative">
                @foreach ($event->getMedia() as $mediaItem)
              <img class="w-full h-72 min-w-100 rounded-xl" src="{{ $mediaItem->getUrl() }}" alt="Colors" />
              @endforeach
              <p class="absolute top-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">{{ $event->price }} Dh</p>
              <p class="absolute top-0 right-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-tr-lg rounded-bl-lg">%20 Discount</p>
            </div>
            <h1 class="mt-4 text-gray-800 text-2xl font-bold cursor-pointer">{{ $event->title }}</h1>
            <div class="my-4">
              <div class="flex space-x-1 items-center">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </span>
                <p>{{ $event->deadline }}</p>
              </div>
              <div class="flex space-x-1 items-center">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </span>
                <p>{{ $event->nombre_place }} Places</p>
              </div>
              <div class="flex space-x-1 items-center">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none"
                       viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                  </svg>
                </span>
                <p>{{ $event->city->ville }}</p>
              </div>
              <a href="details/{{ $event->id }}">
                <button class="mt-4 text-xl w-full text-white bg-indigo-600 py-2 rounded-xl shadow-lg">Voir les détails</button>
            </a>
            </div>
          </div>
          @empty
          <p>No events Found</p>
          @endforelse
    </div>
</div>

@endsection
