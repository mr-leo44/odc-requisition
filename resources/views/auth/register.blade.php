<x-guest-layout>
    <div class="flex flex-col lg:flex-row h-screen bg-white dark:bg-[#121827] ">
        <!-- Image desktop -->
        <div class="hidden lg:block lg:w-7/5 dark:bg-100">
            <img src="{{ asset('img/regist.png') }}" class="object-cover w-full h-full" alt="">
        </div>

        <!-- l'image sur mobile -->
        <div class="block order-first lg:hidden w-full h-1/4 mb-8  bg-white">
            <img class="object-cover w-full h-full" src="{{ asset('img/regist.png') }}" alt="">
            <div class="flex flex-col items-center -mt-20">
                <img src="{{ asset('img/orange.png') }}" class="w-40 border-1" alt="profile">
            </div>
            <!-- Nom de l'application pour mobile -->
            {{-- <div class="flex justify-center mt-1">
                <svg class="w-[32px] h-[32px] text-[#ff7900]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M16.153 19 21 12l-4.847-7H3l4.848 7L3 19h13.153Z" />
                </svg>
                <h1 class="flex space-x-1text-2xl font-bold text-gray-700 mt-1">
                    Réquisition
                </h1> </div> --}}
        </div>

        <!-- Partie Formulaire -->

        <div class="flex items-center justify-center w-full lg:w-2/5 px-6 py-3 mt-16 md:mt-16 lg:mt-0">
            <div class="w-full max-w-md">
                {{-- <div class="hidden lg:flex justify-start mb-4">
                    <svg class="w-[42px] h-[42px] text-orange-500 dark:text-orange-500" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M16.153 19 21 12l-4.847-7H3l4.848 7L3 19h13.153Z" />
                    </svg>
                    <h1 class=" flex space-x-2 text-2xl font-bold text-gray-700 mt-1">
                        Réquisition</h1>
                </div> --}}
                <div class="flex justify-center">
                    <div class="hidden lg:block">
                        <img src="{{ asset('img/orange.png') }}" class="w-20 border-1" alt="profile">
                    </div>
                </div>
                <div class="mt-8 text-center">

                    <p class="mt-4 text-base text-gray-700 dark:text-gray-400 text-left ">Veuillez compléter votre profil</p>
                </div>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mt-4 ui-widget" id="direction">

                        <label for="search_direction" class="font-bold dark:text-white">Direction </label>
                        <input type="text" name="direction" id="search_direction"
                            class="border-gray-300 bg-transparent block w-full px-5 py-3 text-base text-black font-extrabold dark:text-white  placeholder-black transition duration-500 ease-in-out transform rounded-lg bg-[#ff7900] dark:bg-[#ff7900] focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">

                        @if (session('error'))
                            <x-input-error :messages="session('error')" class="mt-2" />
                        @endif
                        <x-input-error :messages="$errors->get('direction')" class="mt-2" />
                    </div>
                    <div class="mt-4 ui-widget" id="service">
                        <label for="search_service" class="font-bold dark:text-white">Service </label>
                        <input type="text" name="service" id="search_service"
                            class="border-gray-300 bg-transparent block w-full px-5 py-3 text-base text-black font-extrabold dark:text-white placeholder-gray-300 transition duration-500 ease-in-out transform rounded-lg bg-[#ff7900] dark:bg-[#ff7900] focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">

                        <x-input-error :messages="$errors->get('service')" class="mt-2" />

                    </div>
                    <div class="mt-4 ui-widget" id="manager">
                        <label for="search_manager" class="font-bold dark:text-white">Manager </label>
                        <input type="text" name="manager" id="search_manager"
                            class="border-gray-300 bg-transparent block w-full px-5 py-3 text-base text-black font-extrabold dark:text-white placeholder-gray-300 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 dark:bg-[#ff7900] focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">

                        <x-input-error :messages="$errors->get('manager')" class="mt-2" />
                    </div>

                    <div class="mt-4 ui-widget" id="city">
                        <label for="search_city" class="font-bold dark:text-white">Ville </label>
                        <input type="text" name="city" id="search_city"
                            class="border-gray-300 bg-transparent block w-full px-5 py-3 text-base text-black font-extrabold dark:text-white placeholder-gray-300 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 dark:bg-[#ff7900] focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">

                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>


                    <div class="text-center mt-4">
                        <x-primary-button class="w-full px-4 py-3 flex justify-center items-center bg-[#ff7900] dark:bg-black">
                            Valider
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    <script type="text/javascript">
        $(function getDarkMode() {
                return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            }
            // Applique le style en fonction du mode du navigateur
            function applyDarkMode() {
                const registerUser = document.getElementById('registerUser');
                if (getDarkMode()) {
                    registerUser.classList.remove('light');
                    registerUser.classList.add('dark');
                } else {
                    registerUser.classList.remove('dark');
                    registerUser.classList.add('light');
                }
            }
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change',
        applyDarkMode); applyDarkMode();

        );


        $(function() {
            var users = @json($users);
            var usersData = []
            for (var i = 0; i < users.length; i++) {
                usersData.push(users[i]['first_name'] + ' ' + users[i]['last_name']);
            }

            $("#search_manager").autocomplete({
                source: usersData,
            });

            var directions = @json($directions);
            var directionsData = []

            for (var i = 0; i < directions.length; i++) {
                directionsData.push(directions[i]['name']);
            }

            $("#search_direction").autocomplete({
                source: directionsData
            });

            var services = @json($services);
            var servicesData = []

            for (var i = 0; i < services.length; i++) {
                servicesData.push(services[i]['service']);
            }

            $("#search_service").autocomplete({
                source: servicesData
            });



            var cities = @json($city);
            var citiesData = []

            for (var i = 0; i < cities.length; i++) {
                citiesData.push(cities[i]['city']);
            }

            $("#search_city").autocomplete({
                source: citiesData
            });


            // Logique pour afficher les erreurs sous les champs respectifs
            @if ($errors->has('direction'))
                $('html, body').animate({
                    scrollTop: $("#search_direction").offset().top
                }, 1000);
            @elseif ($errors->has('city'))
                $('html, body').animate({
                    scrollTop: $("#search_city").offset().top
                }, 1000);
            @elseif ($errors->has('manager'))
                $('html, body').animate({
                    scrollTop: $("#search_manager").offset().top
                }, 1000);
            @endif
        })
    </script>
</x-guest-layout>
