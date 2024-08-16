<x-app-layout>
    <div class="h-full bg-white dark:bg-gray-800 p-8 rounded-lg">
        <div class="flex flex-col flex-1 w-full overflow-y-auto">
            <div class="grid grid-cols-4 gap-6 mb-4 px-4">
                <div
                    class="transform hover:scale-105 transition duration-300 shadow-xl rounded-lg bg-white dark:bg-gray-700">
                    <a href="#">
                        <div class="p-3">
                            <div class="flex justify-between items-center">
                                <div class="px-1 text-gray-700 dark:text-white">
                                    <p class="text-xl font-bold">Toutes les Demandes</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 3v4a1 1 0 0 1-1 1H5m4 10v-2m3 2v-6m3 6v-3m4-11v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                                </svg>
                            </div>
                            <div class="ml-2 w-full flex-1">
                                <div class="mt-4 text-gray-600 dark:text-white text-2xl">
                                    {{ $stats['all_reqs'] }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div
                    class="transform hover:scale-105 transition duration-300 shadow-xl rounded-lg bg-white dark:bg-gray-700">
                    <a href="#">
                        <div class="p-3"> <!-- Réduction du padding ici -->
                            <div class="flex justify-between items-center">
                                <div class="px-1 text-gray-700 dark:text-white"> <!-- Réduction du padding ici -->
                                    <p class="text-xl font-bold">Demandes du mois</p>
                                    <!-- Taille du texte réduite -->
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <!-- Réduction de la taille de l'icône -->
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" />
                                </svg>
                            </div>
                            <div class="ml-1 w-full flex-1">
                                <div class="mt-3 text-gray-600 dark:text-white text-2xl">
                                    <!-- Réduction de la taille du texte ici -->
                                    {{ $stats['month_count'] }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div
                    class="transform hover:scale-105 transition duration-300 shadow-xl rounded-lg bg-white dark:bg-gray-700">
                    <a href="{{ route('demandes.index') }}">
                        <div class="p-3">
                            <div class="flex justify-between items-center">
                                <div class="px-1 text-gray-700 dark:text-white">
                                    <p class="text-xl font-bold">Demandes en cours</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                                </svg>
                            </div>
                            <div class="ml-2 w-full flex-1">
                                <div class="mt-4 text-gray-600 dark:text-white text-2xl">
                                    {{ $stats['ongoing'] }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div
                    class="transform hover:scale-105 transition duration-300 shadow-xl rounded-lg bg-white dark:bg-gray-700 ">
                    <a href="#">
                        <div class="p-3">
                            <div class="flex justify-between items-center">
                                <div class="px-1 text-gray-700 dark:text-white">
                                    <p class="text-xl font-bold">Top direction</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-gray-700 dark:text-yellow-300" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                                </svg>
                            </div>
                            <div class="ml-2 w-full flex-1">
                                <div class="mt-4 text-gray-600 dark:text-white text-xl">
                                    {{ $best_direction->name }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 my-8 px-4">
                <div class="dark:bg-gray-800">
                    <canvas id="verticalBarChart" style="display: block; box-sizing: border-box;"
                        class="w-full dark:text-white"></canvas>
                </div>
                <div class="dark:bg-gray-800">
                    <canvas id="myChart2" height="400" style="display: block; box-sizing: border-box;"
                        class="w-full h-auto dark:text-white"></canvas>
                </div>
            </div>
            <div class="w-full px-4 my-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                N°DEMANDE
                            </th>
                            <th scope="col" class="px-6 py-3">
                                SERVICE
                            </th>
                            <th scope="col" class="px-6 py-3">
                                UTILISATEUR
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ACTIONS
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ongoing_reqs as $ongoing)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $ongoing->numero }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $ongoing->service }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ongoing->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('demandes.show', $ongoing->id) }}"
                                    class=" bg-blue-500 px-10 py-1 text-white rounded">Voir</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-3 px-3">
                    {{ $ongoing_reqs->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        var months = @json($months);

        var month_names = []
        var month_counts = []

        for (var i = 0; i < months.length; i++) {
            month_names.push(months[i]['name']);
            month_counts.push(months[i]['count']);
        }

        console.log(month_counts, month_names);

        const dataVerticalBarChart = {
            labels: month_names,
            datasets: [{
                label: 'Total des demandes',
                data: month_counts,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                hoverOffset: 25,
                borderWidth: 3
            }]
        };
        const configVerticalBarChart = {
            type: 'bar',
            data: dataVerticalBarChart,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Requisitions par mois',
                        font: {
                            size: 24
                        }
                    }
                }
            },
        };

        var verticalBarChart = new Chart(
            document.getElementById('verticalBarChart'),
            configVerticalBarChart
        );

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
                    borderColor: [' rgb(135, 206, 250)'],
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
            type: 'doughnut',
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 50,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Requisitions par directions',
                        font: {
                            size: 24
                        }
                    }
                }
            },
            data: {
                labels: directionsName,
                datasets: [{
                    label: "Les statistiques par rapport aux directions",
                    data: directionsReq,
                    backgroundColor: [
                        'Lavender',
                        'Orange',
                        ' rgb(135, 206, 250)',
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