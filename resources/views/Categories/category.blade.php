@extends('layout')

@section('content')
<main class="min-h-screen">
    <h1 class="text-4xl text-blue-800 py-16 text-center font-bold">Categories</h1>

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
            <button type="submit" name="submit" class="flex justify-center bg-blue-400 text-black border-2 w-full font-bold p-4 rounded-lg">
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
    
    <div class="w-full flex flex-wrap h-fit gap-10 m-5 pt-20 justify-center">
        @forelse ($categories as $category)
        <div class="w-1/4 border-2 text-center rounded-lg">
            <form action="{{ route('category.edit') }}" method="post"> 
                @csrf
                @method('PUT')
                <input type="hidden" name="categoryId" value="{{ $category['id'] }}">
                <input name="name" class="mt-2 text-center text-2xl font-bold text-gray-500" value="{{ $category['name'] }}"/>
            <p class="my-4 text-center text-sm text-gray-500">Disponible depuis :{{ $category['created_at'] }}</p>
            <div class="space-x-4 bg-blue-100 py-4 flex justify-center text-center">

                <button type="submit" name="modifier" class="inline-block rounded-md bg-green-500 px-6 py-2 font-semibold text-black shadow-md duration-75 hover:bg-green-400">Modifier</button>
            </form> 
            <form action="{{ route('category.delete') }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="categoryId" value="{{ $category['id'] }}">
            <button type="submit" name="supprimer" class="inline-block rounded-md bg-red-500 px-10 py-2 font-semibold text-black shadow-md duration-75 hover:bg-red-400">Supprimer</button>
            </div>
        </form> 
        </div>
        @empty
        <p>No categories Found</p>
        @endforelse
    </div>
   
    </div>
 </div>
 </div>  

</main>
@endsection
