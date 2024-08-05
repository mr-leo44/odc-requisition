<x-guest-layout>
    @if (session('error'))
        <div id="error-message"
            class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ session('error') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                data-dismiss-target="#error-message" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="text-center font-bold">
            <x-input-label for="type" :value="__('Completez le profil')" />
        </div>
        <div class="mt-4 ui-widget" id="direction">
            <x-input-label for="search_direction" :value="__('Votre direction')" />
            <x-text-input id="search_direction" class="block mt-1 w-full" type="text" name="direction"
                :value="old('direction')" required />
            <x-input-error :messages="$errors->get('direction')" class="mt-2" />
        </div>
        <div class="mt-4 ui-widget" id="service">
            <x-input-label for="search_service" :value="__('Votre service')" />
            <x-text-input id="search_service" class="block mt-1 w-full" type="text" name="service" :value="old('service')"
                required />
            <x-input-error :messages="$errors->get('service')" class="mt-2" />

        </div>
        <div class="mt-4 ui-widget">
            <x-input-label for="search_manager" :value="__('Votre Manager')" />
            <x-text-input id="search_manager" class="block mt-1 w-full" type="text" name="manager" :value="old('manager')"
                required />
            <x-input-error :messages="$errors->get('manager')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4" type="submit">
                {{ __('Valider') }}
            </x-primary-button>
        </div>
    </form>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var users = @json($users);
            var usersData = []
            for (var i = 0; i < users.length; i++) {
                usersData.push(users[i]['name']);
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
