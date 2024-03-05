@extends('layout')

@section('content')
<main class="h-screen flex items-center">
    <div class="max-w-lg w-1/2 mx-auto my-10 bg-gray-300 rounded-lg shadow-md p-5">
        @foreach ($user->getMedia() as $mediaItem)
            <img class="w-56 h-56 rounded-full mx-auto" src="{{ $mediaItem->getUrl() }}" alt="Profile picture">
            @endforeach
            <h2 class="text-center text-2xl font-semibold mt-3">{{ $user['name'] }}</h2>
            <p class="text-center text-gray-600 mt-1">{{ $user['email'] }}</p>
        
    </div>
  </main>*
  @endsection
