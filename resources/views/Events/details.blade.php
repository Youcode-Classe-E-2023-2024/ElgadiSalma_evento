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
            <div class="w-full flex justify-center">
            @foreach ($event->getMedia() as $mediaItem)
                <img class="w-2/3 h-80" src="{{ $mediaItem->getUrl() }}" />
            @endforeach
        </div>
            <div class="flex flex-wrap w-2/3 justify-between">
                <div class="w-2/3 border-2">
                    <div class="w-2/3 px-2 flex flex-col gap-5 text-gray-700">  
                        <h2 class="text-3xl font-semibold text-blue-800">{{ $event->title }}</h2>
                        <h3 class="font-bold text-bold text-blue-600 mb-2">{{ $event->city->ville }}</h3>                
                        <p class="">{{ $event->description }}</p>
                    </div>
                </div>
                @if($placesRestantes > 0)
                <div class="w-1/3 border-2">
                    <div class="flex flex-col bg-black rounded-3xl">
                        <div class="px-6 py-8 sm:p-10 sm:pb-6">
                          <div class="grid items-center justify-center w-full grid-cols-1 text-left">
                            <div>
                            <form action="{{ route('reserver.event') }}" method="POST">
                            @csrf
                            <input type="hidden" name="acceptation" id="" value="{{ $event->acceptation }}">
                            <input type="hidden" name="idEvent" value="{{ $event->id }}">
                              <h2 class="text-lg font-medium tracking-tighter text-white lg:text-3xl">
                                Reserver
                              </h2>
                              <p class="mt-2 text-sm text-gray-100">Email</p>
                              <input class="w-full rounded px-2 py-1" type="email" name="email" placeholder="Email">
                                @error('email')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-6">
                              <p>
                                <span class="text-2xl font-light tracking-tight text-white">
                                    {{ $event->price }} DH 
                                </span>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="flex px-6 pb-8 sm:px-8">
                          <a aria-describedby="tier-starter" class="items-center justify-center w-full px-6 py-2.5 text-center text-black duration-200 bg-white border-2 border-white rounded-full nline-flex hover:bg-transparent hover:border-white hover:text-white focus:outline-none focus-visible:outline-white text-sm focus-visible:ring-white">
                            <button type="submit">Get started</button>
                          </a>
                        </div>
                    </form>
                      </div>
                </div>
                @else
                <div class="w-1/3 border-2">
                  <div class="flex flex-col bg-black rounded-3xl">
                      <div class="px-6 py-8 sm:p-10 sm:pb-6">
                        <div class="grid items-center justify-center w-full grid-cols-1 text-left">
                          <div>
                            <h2 class="text-lg font-medium tracking-tighter text-white lg:text-3xl">
                              Reserver
                            </h2>
                          </div>
                          <div class="mt-6">
                            <p>
                              <span class="text-2xl text-red-600 font-light tracking-tight text-white">
                                  Sold Out
                              </span>
                            </p>
                          </div>
                        </div>
                      </div>
                  </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
          
        </main>
 
  </div>

@endsection
