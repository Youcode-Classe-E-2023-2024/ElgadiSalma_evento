@extends('layout')

@section('content')

<h1 class="text-4xl text-purple-500 pt-20 text-center font-bold">Statistiques</h1>
<div id="statistique">
    <!-- graphe -->
        <div class="pt-20 flex justify-center">
        <div class=" gap-10 flex flex-wrap w-full justify-center">
        <div class="w-1/2 py-6 px-6 1/3 rounded-xl border border-gray-800 bg-white">
            <h5 class="text-xl text-gray-700">Abonnement</h5>
            <canvas id="subscriberChart" class="w-full" height="150"></canvas>
        </div>

    <!-- end graphe -->

        <div class=" w-1/2 py-6 px-6 rounded-xl flex flex-col gap-5 bg-gray-100 text-center border border-gray-800 bg-white">
            <div>
                <h5 class="text-xl text-black font-bold"><ins>Nombre d'abonnés :</ins></h5>
                <h1 class="text-2xl text-gray-600">abonnés</h1>
            </div>

            </div>
        </div>
        </div>

    <!-- Ajoutdu bouton d'exportation PDF -->
    <div class="flex justify-center pt-10 mt-6">
        <button class="bg-purple-300 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onclick="pdf()">Exporter en PDF</button>
    </div>
</div>

@endsection
