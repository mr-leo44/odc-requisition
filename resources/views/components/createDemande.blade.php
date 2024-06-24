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
                    {{-- <div class="flex justify-end input-group-append">
                        <x-primary-button class="add-input text-sm">
                            {{ __('Ajouter') }}
                        </x-primary-button>
                    </div> --}}
                    <form class="w-full" action="{{ route('demandes.store') }}" method="POST">
                        @csrf
                        <div id="input-container">
                            <div class="grid gap-4 mb-6 md:grid-cols-6">
                                <div class="col-span-5">
                                    <div class="grid gap-32 grid-cols-3">
                                        <div class="col-span-2">
                                            <x-input-label
                                                class="flex-start font-bold block mb-2 text-sm text-gray-900 dark:text-white"
                                                for="designation" :value="__('Designation')" />
                                        </div>

                                        <div class="">
                                            <x-input-label
                                                class="flex-start font-bold block mb-2 text-sm text-gray-900 dark:text-white"
                                                for="qte_demandee" :value="__('Quantité')" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="button"
                                        class="add-input  text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-md p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 12h14m-7 7V5" />
                                        </svg>
                                        <span class="sr-only">Icon description</span>
                                    </button>
                                </div>
                            </div>
                            <div class="grid gap-4 mb-6 md:grid-cols-6 input-group">
                                <div class="col-span-5">
                                    <div class="flex justify-between gap-3">
                                        <x-text-input id="designation"
                                            class="bg-gray-50 w-[80%] border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                            type="text" name="demandes[0][designation]" :value="old('designation')"
                                            placeholder="Ex. Rame papier duplicataire" required autofocus
                                            autocomplete="designation" />
                                        <x-input-error :messages="$errors->get('designation')" class="mt-2" />

                                        <x-text-input id="qte_demandee"
                                            class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-[23.8%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                            type="number" name="demandes[0][qte_demandee]" :value="old('qte_demandee')" required
                                            autofocus autocomplete="qte_demandee" placeholder="Ex. 10" />
                                        <x-input-error :messages="$errors->get('qte_demandee')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <button type="button"
                                        class="delete-input text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-md p-2.5 text-center inline-flex items-center me-2 dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">
                                        <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 12h14" />
                                        </svg>

                                        <span class="sr-only">Icon description</span>
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="flex justify-start mb-4">
                            <button type="submit" class="block text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800
                                ">
                                Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var i = 0;
            $('.add-input').click(function(e) {
                e.preventDefault();
                i++;
                $('#input-container').append(`
                    <div class="grid gap-4 mb-6 md:grid-cols-6 input-group">
                        <div class="col-span-5">
                            <div class="flex justify-between gap-3">
                                <x-text-input id="designation"
                                    class="bg-gray-50 w-[80%] border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                    type="text" name="demandes[${i}][designation]" :value="old('designation')"
                                    placeholder="Ex. Rame papier duplicataire" required autofocus
                                    autocomplete="designation" />
                                <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                                <x-text-input id="qte_demandee"
                                    class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-[23.8%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                    type="number" name="demandes[${i}][qte_demandee]" :value="old('qte_demandee')" regreen
                                    autofocus autocomplete="qte_demandee" placeholder="Ex. 10"/>
                                <x-input-error :messages="$errors->get('qte_demandese')" class="mt-2" />
                            </div>
                        </div>
                            <div class="mt-auto">
                                <button type="button"
                                    class="delete-input text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-md p-2.5 text-center inline-flex items-center me-2 dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">
                                    <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 12h14" />
                                    </svg>

                                    <span class="sr-only">Icon description</span>
                                </button>
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
        // Sélectionnez le bouton de fermeture du modal
        // Sélectionnez le bouton de fermeture du modal
        const closeModalButton = document.querySelector('[data-modal-hide="authentication-modal"]');

        // Sélectionnez le formulaire dans le modal
        const form = document.querySelector('#authentication-modal form');

        // Sélectionnez le conteneur du formulaire
        const formContainer = document.querySelector('#input-container');

        // Ajoutez un événement de clic sur le bouton de fermeture
        closeModalButton.addEventListener('click', () => {
            // Supprimez le formulaire
            form.reset();
        });
    </script>

</div>
</div>
</div>
