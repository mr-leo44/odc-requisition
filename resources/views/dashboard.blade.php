<x-app-layout>
    <div class="h-full bg-white dark:bg-gray-800 p-8 rounded-lg">
        <div class="flex flex-col flex-1 w-full overflow-y-auto">
            {{-- <header class="z-40 py-4 text-gray-700 dark:text-white">
                <div class="flex demandes-center justify-between h-8 px-6 mx-auto">
                    <p>
                            {{ \Carbon\Carbon::now()->locale('fr')->isoFormat('dddd DD MMMM YYYY') }}
                    </p>
                </div>
            </header> --}}
            <main>
                <div class="mb-4 pb-10 px-8 w-full">
                    <div class="grid grid-cols-3 gap-6">
                        <a class="transform hover:scale-105 transition duration-300 shadow-xl rounded-lg bg-white dark:bg-gray-700"
                            href="#">
                            <div class="p-5">
                                <div class="flex justify-between items-center">
                                    <div class="px-2 text-gray-700 dark:text-white">
                                        <p class="text-2xl font-bold">Toutes les Demandes
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 3v4a1 1 0 0 1-1 1H5m4 10v-2m3 2v-6m3 6v-3m4-11v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                                    </svg>
                                </div>
                                <div class="ml-2 w-full flex-1">
                                    <div class="mt-4 text-gray-600 dark:text-white text-3xl">
                                        {{ $nbre_demande }}</div>
                                </div>
                            </div>
                        </a>
                        <a class="transform hover:scale-105 transition duration-300 shadow-xl rounded-lg bg-white dark:bg-gray-700"
                            href="{{ route('demandes.index') }}">
                            <div class="p-5">
                                <div class="flex justify-between items-center">
                                    <div class="px-2 text-gray-700 dark:text-white">
                                        <p class="text-2xl font-bold">Demandes validées
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                                    </svg>
                                </div>
                                <div class="ml-2 w-full flex-1">
                                    <div class="mt-4 text-gray-600 dark:text-white text-3xl">
                                        {{ $nbre_validated }}</div>
                                </div>
                            </div>
                        </a>
                        <a class="transform hover:scale-105 transition duration-300 shadow-xl rounded-lg bg-white dark:bg-gray-700"
                            href="#">
                            <div class="p-5">
                                <div class="flex justify-between items-center">
                                    <div class="px-2 text-gray-700 dark:text-white">
                                        <p class="text-2xl font-bold">Top direction
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-700 dark:text-yellow-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                                    </svg>
                                </div>
                                <div class="ml-2 w-full flex-1">
                                    <div class="mt-4 text-gray-600 dark:text-white text-xl">
                                        {{ $best_direction->name }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-span-12 mt-5">
                        <div class="grid gap-2 grid-cols-1 lg:grid-cols-2">
                            <div class="bg-white shadow-lg p-4" id="chartline"></div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var chart = document.querySelector('#chartline')
        var options = {
            series: [{
                name: 'POOL A',
                type: 'area',
                data: [44, 55, 31, 47, 31, 43, 26, 41, 31, 47, 33]
            }, {
                name: 'POOL B',
                type: 'line',
                data: [55, 69, 45, 61, 43, 54, 37, 52, 44, 61, 43]
            }],
            chart: {
                height: 450,
                with: 300,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            stroke: {
                curve: 'smooth'
            },
            fill: {
                type: 'solid',
                opacity: [0.35, 1],
            },
            labels: ['janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aôut', 'Septembre ',
                'Octobre', 'Novembre', 'Decembre'
            ],
            markers: {
                size: 0
            },
            yaxis: [{
                    title: {
                        text: 'Series A',
                    },
                },
                {
                    opposite: true,
                    title: {
                        text: 'Series B',
                    },
                },
            ],
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function(y) {
                        if (typeof y !== "undefined") {
                            return y.toFixed(0) + " points";
                        }
                        return y;
                    }
                }
            }
        };
        var chart = new ApexCharts(chart, options);
        chart.render();
    </script>
    <script>
        var chart = document.querySelector('#chartpie')
        var options = {
            series: [document.querySelector('#span4').textContent, document.querySelector('#span1').textContent,
                document.querySelector('#span3').textContent, document.querySelector('#span2').textContent
            ],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Total Demandes',
                            formatter: function(w) {
                                var total = document.querySelector('#total')
                                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                return total.value
                            }
                        }
                    }
                }
            },
            labels: [],
        };
        var chart = new ApexCharts(chart, options);
        chart.render();
    </script>
</x-app-layout>