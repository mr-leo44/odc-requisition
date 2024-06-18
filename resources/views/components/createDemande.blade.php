<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true"
    class="hidden mx-auto overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center max-w-7xl md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-5xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Initier une demande
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="authentication-modal">
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
                <div class="max-h-auto mx-auto max-w-5xl">

                    @if ($errors->any())
                        <div class="bg-red-500 text-white px-3 py-2 rounded-lg mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="flex justify-end input-group-append">
                        <x-primary-button class="add-input text-sm">
                            {{ __('Ajouter') }}
                        </x-primary-button>
                    </div>
                    <form class="w-full" action="{{ route('demandes.store') }}" method="POST">
                        @csrf
                        <div id="input-container">
                            <div class="grid gap-3 md:grid-cols-3 mb-3 text-white">
                                <div>
                                    Désignation
                                </div>
                                <div>
                                    Quantité
                                </div>
                            </div>
                            <div class="grid gap-3 mb-6 md:grid-cols-3 input-group">
                                <div>
                                    {{-- <x-input-label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="designation" :value="__('Designation')" /> --}}
                                    <x-text-input id="designation"
                                        class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        type="text" name="demandes[0][designation]" :value="old('designation')"
                                        placeholder="Ex. Rame papier duplicataire" required autofocus
                                        autocomplete="designation" />
                                    <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                                </div>
                                <div>
                                    {{-- <x-input-label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="qte_demandee" :value="__('Quantité')" /> --}}
                                    <x-text-input id="qte_demandee"
                                        class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        type="number" name="demandes[0][qte_demandee]" :value="old('qte_demandee')" required
                                        autofocus autocomplete="qte_demandee" />
                                    <x-input-error :messages="$errors->get('qte_demandee')" class="mt-2" />

                                </div>

                                <div class="mt-2.5">
                                    <a href="#"
                                        class="cancelButton text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Réinitialiser</a>
                                </div>

                            </div>
                        </div>
                        <div class="flex justify-start mb-4">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    var i = 0;
                    $('.add-input').click(function(e) {
                        e.preventDefault();
                        i++;
                        $('#input-container').append(`
                <div class="grid gap-3 mb-6 md:grid-cols-3 input-group">
                    <div>
                        <x-text-input id="designation"
                            class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            type="text" name="demandes[${i}][designation]" :value="old('designation')"
                            placeholder="Ex. Rame papier duplicataire" required autofocus
                            autocomplete="designation" />
                        <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                    </div>
                    <div>
                        <x-text-input id="qte_demandee"
                            class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            type="number" name="demandes[${i}][qte_demandee]" :value="old('qte_demandee')" required
                            autofocus autocomplete="qte_demandee" />
                        <x-input-error :messages="$errors->get('qte_demandee')" class="mt-2" />
                    </div>

                    <div class="mt-2.5">
                           <a href="#" class="delete-input text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Supprimer</a>

                    </div>

                </div>
            `);
                    });
                    // Ajout de la fonction de suppression
                    $(document).on('click', '.delete-input', function(e) {
                        e.preventDefault();
                        const inputGroups = $('.input-group');
                        if (inputGroups.length === 1) {
                            $('#designation').val('');
                            $('#qte_demandee').val('');
                        } else {
                            $(this).closest('.input-group').remove();
                        }
                    });
                });
            </script>

        </div>
    </div>
</div>
