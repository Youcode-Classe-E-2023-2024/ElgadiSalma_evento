@extends('layout')

@section('content')
    <h1 class="text-4xl text-blue-800 py-4 text-center font-bold"></h1>

    <!-- form pour add Categories -->
    <form action="{{ route('category.add') }}" method="post">
    @csrf
    <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2 border-2">
        <div>
            <div class="mb-5">
                <label for="Tag name" class="block mb-2 font-bold text-gray-600 uppercase">Category name</label>
                <input type="text" id="name" name="name" placeholder="Category name." class="border border-gray-300 shadow p-3 w-full rounded " required>
            </div>
        </div>
        <div class="flex justify-between">
            <button type="submit" name="submit" class="flex justify-center bg-green-500 text-black border-2 w-full font-bold p-4 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Save
            </button>
        </div>
    </div>
    </form>

    <!--  -->


    <!-- display Categories -->
    <h1 class="text-4xl text-blue-800 py-10 text-center font-bold">Categories disponibles</h1>
        
    <div class="flex flex-wrap text-center gap-10 mt-10 justify-center">
        @forelse ($categories as $category)

        <div class="w-full max-w-sm overflow-hidden rounded-lg border-2 bg-white shadow-md duration-300 hover:scale-105 hover:shadow-xl"> 
            <form action="" method="post"> 
        <input name="name" class="mt-2 text-center text-2xl font-bold text-gray-500" value="{{ $category['name'] }}"/>
        <p class="my-4 text-center text-sm text-gray-500">Disponible depuis :{{ $category['created_at'] }}</p>
        <div class="space-x-4 bg-gray-100 py-4 flex justify-center text-center">

        <button type="submit" name="modifier" class="inline-block rounded-md bg-green-500 px-6 py-2 font-semibold text-green-100 shadow-md duration-75 hover:bg-green-400">Modifier</button>
        </form> 

        <form action="" method="post">
        <button type="submit" name="supprimer" class="inline-block rounded-md bg-red-500 px-10 py-2 font-semibold text-red-100 shadow-md duration-75 hover:bg-red-400">Supprimer</button>
        </form> 
        </div>
        @empty
        <p>No categories Found</p>
        @endforelse


  
    </div>  

    
@endsection
