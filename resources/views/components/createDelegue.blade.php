@props(['users'])
<div id="popup-modal" tabindex="-1" aria-hidden="true"
    class="hidden mx-auto overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center max-w-7xl md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Délégation
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
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
                <div class="max-h-auto mx-auto max-w-lg">
                    @if ($errors->any())
                        <div class="bg-red-500 text-white px-3 py-2 rounded-lg mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="w-full" action="{{ route('delegations.store') }}" method="POST">
                        @csrf
                        <div class="ui-widget" id="delegue">
                            <x-input-label for="search_delegue" :value="__('Nom du délégué')" />
                            <x-text-input id="search_delegue" class="block mt-1 w-full" type="text" name="delegue"
                                :value="old('delegue')" placeholder="Rechercher un délégué" required />
                            <x-input-error :messages="$errors->get('delegue')" class="mt-2" />
                        </div>

                        <div class="mt-4 ui-widget" id="delegant">
                            <x-input-label for="search_delegant" :value="__('Nom du délégant')" />
                            <x-text-input id="search_delegant" class="block mt-1 w-full" type="text"
                                name="delegant" :value="old('delegant')" required />
                            <x-input-error :messages="$errors->get('delegant')" class="mt-2" />
                        </div>

                        <div class="mt-4 ui-widget" id="motif">
                            <x-input-label for="search_motif" :value="__('Motif')" />
                            <x-text-input id="search_motif" class="block mt-1 w-full" type="text"
                                name="motif" :value="old('motif')" required />
                            <x-input-error :messages="$errors->get('motif')" class="mt-2" />
                        </div>

                        <div class="mt-4 ui-widget flex justify-between">
                            <div class="mt-4 ui-widget" id="date_debut">
                                <x-input-label for="date_debut" :value="__('Date de début')" />
                                <input type="datetime-local" class="bg-slate-500 rounded-xl" name="date_debut" id="date_debut" required />
                                <x-input-error :messages="$errors->get('date_debut')" class="mt-2" />
                            </div>
                            <div class="mt-4 ui-widget">
                                <x-input-label for="date_fin" :value="__('Date de fin')" />
                                <input type="datetime-local" class="bg-slate-500 rounded-xl" name="date_fin" id="date_fin" required />
                                <x-input-error :messages="$errors->get('date_fin')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex justify-end mt-3 mb-4">
                            <button type="submit"
                                class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                Soumettre
                                    </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
    var users = @json($users);
    var usersData = users.map(user => user.name);

    $(function() {
        // Autocomplétion pour le délégué
        $("#search_delegant").autocomplete({
            source: usersData,
        });
    });

    $(document).ready(function() {
        fetch('http://10.143.41.70:8000/promo2/odcapi/?method=getUsers')
            .then(response => response.json())
            .then(data => {
                // var listData = data.users.map(user => user.name);
                var listData = data.users.map(user => user.first_name + ' ' + user.last_name);

                $("#search_delegue").autocomplete({
                    source: listData,
                });
            })
            .catch(error => console.error('Erreur:', error));
    });
</script>
