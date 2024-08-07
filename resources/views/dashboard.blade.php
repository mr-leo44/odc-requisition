<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        <div class="max-w-screen-xl mx-auto">

            <nav class="bg-white border-gray-200 dark:bg-gray-200">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    @php
                        $dates = Carbon\Carbon::now()->locale('fr')->isoFormat('dddd DD MMMM YYYY');
                    @endphp
                    <p>{{ $dates }}</p>
                    <div class="flex items-center justify-between my-4 mx-10">
                        <div>
                            <a href="{{ route('demandes.index') }}" data-tooltip-target="tooltip-new" type="button"
                                class="inline-flex items-center justify-center w-8 h-8 font-medium bg-orange-400 rounded-full hover:bg-gray-700 group focus:ring-4 focus:ring-blue-200 focus:outline-none dark:focus:ring-gray-700">
                                <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 1v16M1 9h16" />
                                </svg>
                                <span class="sr-only">New item</span>
                            </a>
                        </div>
                        <div id="tooltip-new" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-1 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Voir les demandes
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-4 ">
                <!--<a href="{{ route('demandes.index') }}" data-tooltip-target="tooltip-new" type="button"></a>-->
                <div class="shadow-lg rounded-lg p-8 dark:text-gray-200">
                    <div>Toutes les demandes</div>
                    <div class="font-black text-xl text-center">{{ $nbre_demande }}</div>
                </div>

                <div class="shadow-lg rounded-lg p-8 dark:text-gray-200">
                    <div>Demandes validées</div>
                    <div class="font-black text-xl text-center">{{ $nbre_validated }}</div>
                </div>

                <div class="shadow-lg rounded-lg p-8 dark:text-gray-200">
                    <div>La direction ayant le plus de demande</div>
                    <div class="font-black text-xl text-center">{{ $best_direction->name }}</div>

                </div>



            </div>
    </x-slot>
    <button id="dropdownRadioButton" data-dropdown-toggle="dropdownDefaultRadio"
        class="text-white bg-orange-400 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center
             dark:bg-orange-400 dark:hover:bg-orange-700 dark:focus:ring-orange-800"
        focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
        inline-flex items-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800
        type="button">Liste des directions <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="dropdownDefaultRadio"
        class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
        <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioButton">
            @foreach ($directions as $direction)
                <li>
                    <div class="flex items-center">
                        <input id="default-radio-1" type="radio" value="" name="default-radio"
                            class="w-4 h-4 text-orange-400 bg-gray-100 border-gray-300 focus:ring-orange-500 dark:focus:ring-orange-400 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="default-radio-1"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $direction->name }}</label>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!--chart-->
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 dark:text-gray-200 ">

        <div class=" w-1/2">
            <canvas id="myChart1"></canvas>
        </div>

        <div class=" w-1/3">
            <canvas id="myChart2"></canvas>
        </div>
    </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx1 = document.getElementById('myChart1');
        var directions = @json($directions);
        var directionsName = []
        var directionsReq = []

        for (var i = 0; i < directions.length; i++) {
            directionsName.push(directions[i]['name']);
            directionsReq.push(directions[i]['req_count']);
        }
        console.log(directionsName);

        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: directionsName,
                datasets: [{
                    label: "Les statistiques par rapport aux directions",
                    data: directionsReq,
                    borderColor: ['rgb(255, 159, 64)'],
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx2 = document.getElementById('myChart2');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: directionsName,
                datasets: [{
                    label: "Les statistiques par rapport aux directions",
                    data: directionsReq,
                    backgroundColor: [
                        'Lavender',
                        'Orange',
                        'Chocolate',
                        'Yellow',
                        'Black',
                        'Green',
                        'Pink'
                    ],
                    hoverOffset: 25,
                    borderWidth: 3
                }]
            },

        });
    </script>

</x-app-layout>
