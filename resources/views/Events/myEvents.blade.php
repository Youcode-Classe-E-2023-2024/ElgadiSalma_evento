@extends('layout')

@section('content')

<div class="py-16 sm:py-24 lg:mx-auto lg:max-w-7xl lg:px-8 min-h-screen">
  <h1 class="text-4xl text-blue-800 pb-16 text-center font-bold">My Events</h1>

    <div class="flex flex-wrap justify-center gap-5 w-full px-4 sm:px-6 lg:px-0">
      <form action="{{ route('event.search') }}" class="flex w-full gap-4 justify-center">
        <div class="relative w-1/2">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" name="query" id="searchInput" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 py-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
        </div>
        <button type="submit">
          <span class="circle1"></span>
          <span class="circle2"></span>
          <span class="circle3"></span>
          <span class="circle4"></span>
          <span class="circle5"></span>
          <span class="text">Search</span>
        </button>
      </form>
        <form action="" class="w-full">
        <div class="search w-full">
            <div class="select">
              <div class="select">
                <select name="category" id="category">
                    <option value="all" selected>Category</option>
                    @forelse($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @empty
                    <p>No categories Found</p>
                    @endforelse
                </select>
            </div>
            </div>
            <div class="">
              <button>
                <span class="circle1"></span>
                <span class="circle2"></span>
                <span class="circle3"></span>
                <span class="circle4"></span>
                <span class="circle5"></span>
                <span class="text">Submit</span>
            </button>
            </div>
        </div>
      </form>
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
              <div class="w-full flex gap-2">
                <a href="edit/{{ $event->id }}" class="w-1/2 bg-blue-800 mt-4 text-xl text-white py-2 hover:bg-green-400 rounded-xl shadow-lg">
                    <button class="w-full">Edit</button>
                </a>
                <form action="{{ route('delete.event') }}" method="POST" class="w-1/2 bg-blue-800 mt-4 text-xl text-white py-2 hover:bg-red-400 rounded-xl shadow-lg">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="eventId" value="{{ $event->id }}">
                    <button type="submit" class=" w-full ">Delete</button>
                </form>
            </div>
              <a href="details/{{ $event->id }}">
                <button class="mt-4 text-xl w-full text-white bg-blue-800 py-2 rounded-xl shadow-lg">Voir les détails</button>
              </a>
            </div>
          </div>
          @empty
          <p>No events Found</p>
          @endforelse
    </div>


</div>

@endsection
