<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true"
    class="hidden mx-auto overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center max-w-7xl md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-5xl max-h-full ">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  bg-slate-300 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                    Créer une demande
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-900  bg-gray-200 hover:bg-gray-500 hover:text-gray-100 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
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
                    <form class="w-full" action="{{ route('demandes.store') }}" method="POST">
                        @csrf
                        <div id="input-container">
                            <div class="grid gap-4 md:grid-cols-6">
                                <div class="col-span-5">
                                    <div class="grid gap-32 grid-cols-3">
                                        <div class="col-span-2">
                                            <x-input-label
                                                class="flex-start font-bold block mb-2 text-sm text-gray-900 dark:text-white"
                                                for="designation" :value="__('Désignation')" />
                                        </div>

                                        <div class="">
                                            <x-input-label
                                                class="flex-start font-bold block mb-2 text-sm text-gray-900 dark:text-white"
                                                for="qte_demandee" :value="__('Quantité')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end mb-4">
                                    <button type="button"
                                        class="add-input  text-white bg-slate-300 dark:bg-slate-300 hover:bg-theme focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-md p-2.5 text-center inline-flex items-center me-2">
                                        <svg class="w-5 h-5 text-gray-900 dark:text-black hover:text-white dark:hover:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 12h14m-7 7V5" />
                                        </svg>
                                        <span class="sr-only">Icon description</span>
                                    </button>
                                </div>
                            </div>
                            <div class="grid gap-4 mb-3 md:grid-cols-6 input-group ">
                                <div class="col-span-5">
                                    <div class="flex justify-between gap-3">
                                        <x-text-input id="designation"
                                            class="bg-gray-50 w-[80%] border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                            type="text" name="demandes[0][designation]" :value="old('designation')"
                                            placeholder="Ex. Rame papier duplicataire" required autofocus
                                            autocomplete="off" />
                                        <x-input-error :messages="$errors->get('designation')" class="mt-2" />

                                        <x-text-input id="qte_demandee"
                                            class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-[23.8%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                            type="number" min="1" step="1"
                                            name="demandes[0][qte_demandee]" :value="old('qte_demandee')" required autofocus
                                            autocomplete="off" placeholder="Ex. 10" />
                                        <x-input-error :messages="$errors->get('qte_demandee')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="flex justify-end mb-2">
                                    <button type="button"
                                        class="delete-input text-white bg-slate-700 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-md p-2.5 text-center inline-flex items-center me-2">
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
                        <div class="flex justify-end mb-1">
                            <button type="submit"
                                class="block text-black focus:ring-4 bg-slate-300 dark:bg-slate-300 hover:bg-theme hover:text-white focus:outline-none font-bold rounded-lg text-sm px-10 py-2 text-center">
                                Soumettre
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
            <div class="grid gap-4 md:grid-cols-6 input-group">
                <div class="col-span-5 ">
                    <div class="flex justify-between gap-3">
                        <x-text-input id="designation" class="bg-gray-50 w-[80%] border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" type="text" name="demandes[${i}][designation]" placeholder="Ex. Rame papier duplicataire" required autofocus autocomplete="off" />
                        <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                        <x-text-input id="qte_demandee" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-[23.8%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" type="number" min="1" step="1" name="demandes[${i}][qte_demandee]" required autofocus autocomplete="off" placeholder="Ex. 10"/>
                        <x-input-error :messages="$errors->get('qte_demandee')" class="mt-2" />
                    </div>
                </div>
                <div class="flex justify-end mb-4">
                    <button type="button" class="delete-input text-white bg-slate-700 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-md p-2.5 text-center inline-flex items-center me-2 dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">
                        <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
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

            // Validation du formulaire
            $('form').submit(function(e) {
                let isValid = true;
                $('.input-group').each(function() {
                    const designation = $(this).find('input[name*="[designation]"]').val();
                    const qte_demandee = $(this).find('input[name*="[qte_demandee]"]').val();
                    if (!designation || !qte_demandee) {
                        isValid = false;
                        return false; // Arrête la boucle each
                    }
                });
                if (!isValid) {
                    e.preventDefault(); // Empêche la soumission du formulaire
                }
            });
        });
    </script>

</div>
</div>
</div>
