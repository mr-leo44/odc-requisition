{{-- @props(['users', 'user', 'directions', 'services']) --}}
<div id="modal" tabindex="-1" aria-hidden="true"
    class="hidden mx-auto overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center max-w-7xl md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Modifiez vos informations
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="max-h-auto mx-auto max-w-2xl">
                    @if ($errors->any())
                        <div class="bg-red-500 text-white px-3 py-2 rounded-lg mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="w-full" action="{{ route('profile.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mt-4 ui-widget" id="direction">
                            <x-input-label for="search_direction" :value="__('Direction')" />
                            <x-text-input id="search_direction" class="block mt-1 w-full" type="text"
                                name="direction" :value="old('direction', $user->compte->direction->name)" required />
                            <x-input-error :messages="$errors->get('direction')" class="mt-2" />
                        </div>
                        <div class="mt-4 ui-widget" id="service">
                            <x-input-label for="search_service" :value="__('Service')" />
                            <x-text-input id="search_service" class="block mt-1 w-full" type="text" name="service"
                                :value="old('service', $user->compte->service)" required />
                            <x-input-error :messages="$errors->get('service')" class="mt-2" />

                        </div>


                        <div class="mt-4 ui-widget" id="city">
                            <x-input-label for="search_city" :value="__('Ville')" />
                            <x-text-input id="search_city" class="block mt-1 w-full" type="text" name="city"
                                :value="old('city', $city = $user->compte->city)" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />

                                
                        </div>

                        <div class="mt-4 ui-widget">
                            <x-input-label for="search_manager" :value="__('Manager')" />
                            <x-text-input id="search_manager" class="block mt-1 w-full" type="text" name="manager"
                                :value="old('manager', $user->manager)" required />
                            <x-input-error :messages="$errors->get('manager')" class="mt-2" />
                        </div>


                        <div class="flex justify-start mt-3 mb-4">
                            <button type="submit"
                                class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
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


        var cities = @json($city);
        var citiesData = [];
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
        @elseif ($errors->has('manager'))
            $('html, body').animate({
                scrollTop: $("#search_manager").offset().top
            }, 1000);
        @elseif ($errors->has('city'))
            $('html, body').animate({
                scrollTop: $("#search_city").offset().top
            }, 1000);
        @endif
    })
</script>
