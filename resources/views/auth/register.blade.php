<x-guest-layout>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="text-center font-bold">
            <x-input-label for="type" :value="__('Completez le profil')" />
        </div>
        <div id="step-1">
            <div class="mt-4 ui-widget" id="direction">
                <x-input-label for="search_direction" :value="__('Votre direction')" />
                <x-text-input id="search_direction" class="block mt-1 w-full" type="text" name="direction"
                    :value="old('direction')" required />
                <x-input-error :messages="$errors->get('direction')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4" type="button" id="byStepTwo">
                    {{ __('Suivant') }}
                </x-primary-button>
            </div>
        </div>
        <div id="step-2" class="hidden">
            <div class="mt-4" id="service">
                <x-input-label for="search_service" :value="__('Votre service')" />
                <x-text-input id="search_service" class="block mt-1 w-full" type="text" name="service"
                    :value="old('service')" required />
                <x-input-error :messages="$errors->get('service')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4" id="byStepThree">
                <x-primary-button class="ms-4">
                    {{ __('Suivant') }}
                </x-primary-button>
            </div>
        </div>
        <div id="step-3" class="hidden">
            <div class="mt-4 ui-widget">
                <x-input-label for="search_manager" :value="__('Votre Manager')" />
                <x-text-input id="search_manager" class="block mt-1 w-full" type="text" name="manager"
                    :value="old('manager')" required />
                <x-input-error :messages="$errors->get('manager')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4" type="submit">
                    {{ __('Valider') }}
                </x-primary-button>
            </div>
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
                servicesData.push(services[i]['name']);
            }

            $("#search_service").autocomplete({
                source: servicesData,
            });

            $("#byStepTwo").on('click', function(event) {
                event.preventDefault();
                $("#step-2").removeClass('hidden');
                $("#step-1").addClass('hidden');
            })
            $("#byStepThree").on('click', function(event) {
                event.preventDefault();
                $("#step-3").removeClass('hidden');
                $("#step-2").addClass('hidden');
            })
        })
    </script>
</x-guest-layout>
