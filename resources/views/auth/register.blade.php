<x-guest-layout>
    <div class="max-w-5xl mx-auto">
        <div class="w-full rounded bg-gray-200 dark:bg-slate-800 shadow rounded-l-lg dark:border dark:border-gray-600">
            <div
                class="grid bg-gray-200 dark:bg-slate-800 dark:border-gray-600 grid-cols-1  mx-auto shadow-xl lg:grid-cols-2 gap-2 rounded-xl">
                <div class="hidden items-center lg:flex order-first  w-full rounded-l-lg justify-center">
                    {{-- <x-login-logo /> --}}
                    <img src="{{ asset('img/auth.jpg') }}" class="bg-white bg-cover h-full rounded-l-lg" alt="">
                </div>
                <div class="flex-col justify-between items-center py-2 lg:py-7 px-3 md:px-4 lg:px-4">
                    <div class="flex flex-col items-center">
                        <x-application-logo />
                        <div class="mt-2 text-base text-gray-500 dark:text-white">
                            <p
                                class="font-semibold font-['helvetica'] text-neutral-600 dark:text-white leading-none text-md">
                                Réquisition</p>
                        </div>
                    </div>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="text-center my-4 font-bold">
                            <h3 class="text-lg   dark:text-white">Completez votre profil</h3>
                        </div>
                        <div class="mt-4 ui-widget" id="direction">
                            <x-input-label for="search_direction" :value="__('Votre direction')" />
                            <x-text-input id="search_direction" class="block mt-1 w-full" type="text"
                                name="direction" :value="old('direction')" required />
                            @if (session('error'))
                                <x-input-error :messages="session('error')" class="mt-2" />
                            @endif
                            <x-input-error :messages="$errors->get('direction')" class="mt-2" />
                        </div>
                        <div class="mt-4 ui-widget" id="service">
                            <x-input-label for="search_service" :value="__('Votre service')" />
                            <x-text-input id="search_service" class="block mt-1 w-full" type="text" name="service"
                                :value="old('service')" required />
                            <x-input-error :messages="$errors->get('service')" class="mt-2" />

                        </div>
                        <div class="mt-4 ui-widget">
                            <x-input-label for="search_manager" :value="__('Votre Manager')" />
                            <x-text-input id="search_manager" class="block mt-1 w-full" type="text" name="manager"
                                :value="old('manager')" required />
                            <x-input-error :messages="$errors->get('manager')" class="mt-2" />
                        </div>
                        <div class="text-center mt-3">
                            <x-primary-button class="w-full flex justify-center items-center">
                                Valider
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
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

            // Logique pour afficher les erreurs sous les champs respectifs
            @if ($errors->has('direction'))
                $('html, body').animate({
                    scrollTop: $("#search_direction").offset().top
                }, 1000);
            @elseif ($errors->has('manager'))
                $('html, body').animate({
                    scrollTop: $("#search_manager").offset().top
                }, 1000);
            @endif
        })
    </script>
</x-guest-layout>
