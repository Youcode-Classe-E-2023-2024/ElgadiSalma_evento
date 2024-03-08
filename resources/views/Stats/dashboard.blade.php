@extends('layout')

@section('content')

<h1 class="text-4xl text-blue-700 pt-20 py-10 text-center font-bold">Statistiques</h1>

<div class="flex mx-20 justify-center">
    <!-- card1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p
                                class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                Total Users</p>
                            <h5 class="mb-2 font-bold dark:text-white">{{ $totalusers }} utilisateurs</h5>
                            <p class="mb-0 dark:text-white dark:opacity-60">
                            </p>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div
                            class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                            <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card2 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p
                                class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                Total Categories</p>
                            <h5 class="mb-2 font-bold dark:text-white">{{ $totalcategories }} categories</h5>
                            <p class="mb-0 dark:text-white dark:opacity-60">

                            </p>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div
                            class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                            <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card3 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
    <div
        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                        <p
                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                            Total Event</p>
                        <h5 class="mb-2 font-bold dark:text-white">{{ $totalevents }} event</h5>
                        <p class="mb-0 dark:text-white dark:opacity-60">
                        </p>
                    </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                    <div
                        class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                        <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<div id="statistique">

    <!-- graphe -->
        <div class="pt-20 flex justify-center">
        <div class=" gap-10 flex flex-wrap w-full justify-center">
        <div class="w-1/2 py-6 px-6 1/3 rounded-xl border border-gray-800 bg-white">
            <h5 class="text-xl text-gray-700"><ins>Evenements</ins></h5>
            <canvas id="eventChart" class="w-full" height="150"></canvas>
        </div>
        </div>
        </div>

</div>

<h1 class="text-4xl text-blue-700 pt-20 text-center font-bold">Assign roles</h1>

<div class="flex flex-col items-center">

    <div class="w-1/2 my-20 ">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <ul class="divide-y divide-gray-200 gap-3">

                @forelse ($users as $user)

                <li class="p-3 flex justify-between items-center">
                    <div class="flex items-center">
                        <img class="w-10 h-10 rounded-full" src="https://unsplash.com/photos/oh0DITWoHi4/download?force=true&w=640" alt="Christy">
                        <span class="ml-3 font-medium">{{ $user['email'] }}</span>
                    </div>
                    <div>
                        <form action="" method="post" class="w-1/2 flex">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="userId" value="{{ $user['id'] }}">
                            <select name="idRole" id="">
                                <option value="2">Organisateur</option>
                                <option value="3">Utilisateur</option>
                            </select>
                            <button type="submit" name="supprimer" class="bg-black rounded-md px-5 py-2 font-semibold text-gray-500 duration-75 hover:bg-gray-700 hover:text-purple-100">edit</button>
                        </form>
                    </div>
                </li>

                @empty
                    <p>No subscriber Found</p>
                @endforelse
                
            </ul>
        </div>
    </div>
</div>



<script>
        console.log("salma");
        
        const dates = @json($eventStatistics->pluck('date'));
        const counts = @json($eventStatistics->pluck('event_count'));
    
        const ctx = document.getElementById('eventChart').getContext('2d');
        const eventChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Nombre d\'evenements ajoutés',
                    data: counts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre d\'evenement'
                        }
                    }
                }
            }
        });
    
 
</script>
@endsection
