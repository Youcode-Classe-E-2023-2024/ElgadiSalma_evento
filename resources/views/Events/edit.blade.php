@extends('layout')

@section('content')


<main class="bg-gray-100 h-fit">
    {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <strong> Validation Error!</strong>
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success mt-4">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger mt-4">
                {{ session()->get('error') }}
            </div>
        @endif --}}
<div class="text-4xl text-blue-800 pt-16 text-center font-bold">Ajouter un event</div>

<div class="flex items-center justify-center p-12">
  <div class="w-2/3">
    <div class="mx-auto w-full max-w-[550px]">

        <form action="{{ route('event.edit', $event->id) }}" method="POST">
        @csrf
        <div class="-mx-3 flex flex-wrap">
            <input type="hidden" name="id" >
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                <label for="titre" class="mb-3 block text-base font-medium text-[#07074D]">
                    Titre 
                </label>
                @error('title')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <input type="text" name="title" value={{ $event->title }} placeholder="Titre" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" >
                </div>
            </div>

            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="media" class="mb-3 block text-base font-medium ">
                        Category 
                    </label>
                    @error('category')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    <div class="rounded-md border border-[#e0e0e0] p-1 py-1 bg-white outline-none flex">
                        <select class="rounded w-full pb-2 py-2 px-4 placeholder-gray-500 outline-none" value={{ $event->category->name }} name="category" id="">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach                        
                        </select>         
                    </div>
                </div>    
            </div>   
        </div>

        <div class="-mx-3 flex flex-wrap">
            <input type="hidden" name="id" >
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                <label for="titre" class="mb-3 block text-base font-medium text-[#07074D]">
                    Prix 
                </label>
                @error('price')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <input type="number" name="price" value={{ $event->price }} placeholder="Prix" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" >
                </div>
            </div>

            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="media" class="mb-3 block text-base font-medium ">
                        Lieu 
                    </label>
                    @error('lieu')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    <div class="rounded-md border border-[#e0e0e0] p-1 py-1 bg-white outline-none flex">
                        <select class="rounded w-full pb-2 py-2 px-4 placeholder-gray-500 outline-none" name="lieu" id="">
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->ville }}</option>
                            @endforeach
                        </select>         
                    </div>
                </div>    
            </div>   

            </div>   
        </div>

        <div class="mb-5">
          <label class="mb-3 block text-base font-medium text-[#07074D]">
            Description
          </label>
            @error('description')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
          <input
            type="text"
            value={{ $event->description }}
            name="description"
            placeholder="Description"
            class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            
          />
        </div>

          <div class="-mx-3 flex flex-wrap">

            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="media" class="mb-3 block text-base font-medium ">
                        Date de l'evenement 
                    </label>
                    @error('deadline')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                        <input
                        type="date"
                        value={{ $event->deadline }}
                        name="deadline"
                        placeholder="Jour de l'evenement"
                        class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        
                      />
                </div>    
            </div> 
            
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="media" class="mb-3 block text-base font-medium ">
                        Nombre de place 
                    </label>
                    @error('place')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    <input type="number" value={{ $event->price }} name="place" placeholder="Nombre de place" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" >      
                    </div>
                </div>    
        </div>
        <div class="mb-4 flex items-center">
            <input type="checkbox" id="validation" name="validation" class="text-blue-500">
            <label for="validation" class="text-gray-600 ml-2">Validation manuelle</label>
          </div>

        <div class="my-10">
          <button type="submit" name="submit" class="hover:shadow-form rounded-md bg-gray-100 py-3 px-8 text-center text-base font-semibold w-full border-2 outline-none">
            Submit
          </button>
        </div>

      </form>
    </div>
  </div>
</div>
</main>

@endsection
