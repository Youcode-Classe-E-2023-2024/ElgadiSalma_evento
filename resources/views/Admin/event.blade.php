@php
use Carbon\Carbon;
@endphp
@extends('layout')

@section('content')

<main class="h-fit min-h-screen my-20">

<h1 class="text-4xl text-blue-800 pb-20 text-center font-bold">Events</h1>

<div class="max-w-6xl mx-auto flex flex-col gap-10 px-5">

@forelse ($events as $event)
    <div class="flex flex-col md:flex-row bg-white  rounded-xl md:bg-transparent shadow-lg shadow-black/20 md:shadow-none gap-10">
        
            <div class="container grid grid-cols-12 mx-auto dark:bg-gray-900 border-2">
                @foreach ($event->getMedia() as $mediaItem)
                <div class="bg-no-repeat flex justify-center bg-cover dark:bg-gray-700 col-span-full lg:col-span-4" style=" background-position: center center; background-blend-mode: multiply; background-size: cover;">
                    <img src="{{ $mediaItem->getUrl() }}" alt="">
                </div>
                @endforeach
                <div class="flex flex-col p-6 col-span-full row-span-full lg:col-span-8 lg:p-10">
                    <div class="flex justify-between">

                        <span class="px-2 pb-5 font-bold text-xs rounded-full dark:bg-violet-400 dark:text-gray-900">{{ $event->category->name }}</span>
                        <span class="text-xs">{{ Carbon::parse( $event->created_at )->diffForHumans() }}</span>

                    </div>
                    <h1 class="text-3xl font-semibold">{{ $event->title }}</h1>
                    <p class="flex-1 pt-2">{{ $event->description }}</p>
                    <a rel="noopener noreferrer" href="details/{{ $event->id }}" class="inline-flex items-center pt-2 pb-6 space-x-2 text-sm dark:text-violet-400">
                        <span>Read more</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <span class="text-sm">{{ $event->deadline }}</span>

                </div>
            </div>

        {{-- send --}}
        <form action="{{ route('approuve.events', $event->id) }}" method="POST">
            @csrf
            <div class="flex justify-center md:justify-end h-full">
                <div class="w-[120px] h-[120px] bg-white flex flex-col shadow-lg rounded-xl p-4 flex justify-center items-center">
                    <button type="submit">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-green-500 p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-white">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                          </div>    
                    </button>
                </div>
            </div>
        </form>

        <form action="{{ route('desapprouve.events', $event->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-center md:justify-end h-full">
                <div class="w-[120px] h-[120px] bg-white flex flex-col shadow-lg rounded-xl p-4 flex justify-center items-center">
                    <button type="submit">
                        <svg class="h-16 w-16" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-46.08 -46.08 604.16 604.16" xml:space="preserve" width="256px" height="256px" fill="#f75555" stroke="#f75555" stroke-width="0.00512"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <polygon style="fill:#FF3501;" points="365.714,231.619 365.714,195.048 402.286,195.048 402.286,158.476 438.857,158.476 438.857,121.905 475.429,121.905 475.429,85.333 512,85.333 512,36.571 475.429,36.571 475.429,0 426.667,0 426.667,36.571 390.095,36.571 390.095,73.143 353.524,73.143 353.524,109.714 316.952,109.714 316.952,146.286 280.381,146.286 280.381,182.857 231.619,182.857 231.619,146.286 195.048,146.286 195.048,109.714 158.476,109.714 158.476,73.143 121.905,73.143 121.905,36.571 85.333,36.571 85.333,0 36.571,0 36.571,36.571 0,36.571 0,85.333 36.571,85.333 36.571,121.905 73.143,121.905 73.143,158.476 109.714,158.476 109.714,195.048 146.286,195.048 146.286,231.619 182.857,231.619 182.857,280.381 146.286,280.381 146.286,316.952 109.714,316.952 109.714,353.524 73.143,353.524 73.143,390.095 36.571,390.095 36.571,426.667 0,426.667 0,475.429 36.571,475.429 36.571,512 85.333,512 85.333,475.429 121.905,475.429 121.905,438.857 158.476,438.857 158.476,402.286 195.048,402.286 195.048,365.714 231.619,365.714 231.619,329.143 280.381,329.143 280.381,365.714 316.952,365.714 316.952,402.286 353.524,402.286 353.524,438.857 390.095,438.857 390.095,475.429 426.667,475.429 426.667,512 475.429,512 475.429,475.429 512,475.429 512,426.667 475.429,426.667 475.429,390.095 438.857,390.095 438.857,353.524 402.286,353.524 402.286,316.952 365.714,316.952 365.714,280.381 329.143,280.381 329.143,231.619 "></polygon> <rect x="231.619" y="182.857" width="48.762" height="36.571"></rect> <rect x="231.619" y="292.571" width="48.762" height="36.571"></rect> <rect x="292.571" y="231.619" width="36.571" height="48.762"></rect> <rect x="365.714" y="158.476" width="36.571" height="36.571"></rect> <rect x="280.381" y="146.286" width="36.571" height="36.571"></rect> <rect x="329.143" y="195.048" width="36.571" height="36.571"></rect> <rect x="316.952" y="109.714" width="36.571" height="36.571"></rect> <rect x="402.286" y="121.905" width="36.571" height="36.571"></rect> <rect x="353.524" y="73.143" width="36.571" height="36.571"></rect> <rect x="438.857" y="85.333" width="36.571" height="36.571"></rect> <rect x="390.095" y="36.571" width="36.571" height="36.571"></rect> <rect x="426.667" width="48.762" height="36.571"></rect> <rect x="475.429" y="36.571" width="36.571" height="48.762"></rect> <rect x="365.714" y="316.952" width="36.571" height="36.571"></rect> <rect x="329.143" y="280.381" width="36.571" height="36.571"></rect> <rect x="316.952" y="365.714" width="36.571" height="36.571"></rect> <rect x="402.286" y="353.524" width="36.571" height="36.571"></rect> <rect x="353.524" y="402.286" width="36.571" height="36.571"></rect> <rect x="438.857" y="390.095" width="36.571" height="36.571"></rect> <rect x="390.095" y="438.857" width="36.571" height="36.571"></rect> <rect x="426.667" y="475.429" width="48.762" height="36.571"></rect> <rect y="426.667" width="36.571" height="48.762"></rect> <rect x="36.571" y="475.429" width="48.762" height="36.571"></rect> <rect x="182.857" y="231.619" width="36.571" height="48.762"></rect> <rect x="146.286" y="280.381" width="36.571" height="36.571"></rect> <rect x="109.714" y="316.952" width="36.571" height="36.571"></rect> <rect x="73.143" y="353.524" width="36.571" height="36.571"></rect> <rect x="36.571" y="390.095" width="36.571" height="36.571"></rect> <rect x="85.333" y="438.857" width="36.571" height="36.571"></rect> <rect x="121.905" y="402.286" width="36.571" height="36.571"></rect> <rect x="158.476" y="365.714" width="36.571" height="36.571"></rect> <rect x="195.048" y="329.143" width="36.571" height="36.571"></rect> <rect x="195.048" y="146.286" width="36.571" height="36.571"></rect> <rect x="146.286" y="195.048" width="36.571" height="36.571"></rect> <rect x="158.476" y="109.714" width="36.571" height="36.571"></rect> <rect x="121.905" y="73.143" width="36.571" height="36.571"></rect> <rect x="85.333" y="36.571" width="36.571" height="36.571"></rect> <rect x="109.714" y="158.476" width="36.571" height="36.571"></rect> <rect x="73.143" y="121.905" width="36.571" height="36.571"></rect> <rect x="36.571" y="85.333" width="36.571" height="36.571"></rect> <rect x="280.381" y="329.143" width="36.571" height="36.571"></rect> <rect x="475.429" y="426.667" width="36.571" height="48.762"></rect> <rect x="36.571" width="48.762" height="36.571"></rect> <rect y="36.571" width="36.571" height="48.762"></rect> </g></svg>                    </button>

                </div>
            </div>
        </form>

    </div>
    @empty
        <p>No events Found</p>
    @endforelse


</div>
</main>
@endsection
