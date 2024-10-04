<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true"
    class="hidden mx-auto overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center max-w-3xl md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-5xl max-h-full ">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-lg  bg-gray-900 dark:bg-gray-800  dark:border-gray-600">
                <h3 class="text-xl font-semibold text-white dark:text-white">
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
                <div class="max-h-auto mx-auto max-w-3xl">

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
                                        class="add-input  text-white dark:text-black bg-gray-900 hover:bg-theme dark:bg-slate-300  focus:ring-4 focus:outline-none  font-medium rounded-lg text-md p-2.5 text-center inline-flex items-center me-2">
                                        <svg class="w-5 h-5 text-white dark:text-black hover:text-white dark:hover:text-white"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="none" viewBox="0 0 24 24">
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
                                        class="delete-input text-white bg-slate-700 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-md p-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-900 inline-flex items-center me-2">
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
                            <button type="submit" id="btn-submit"
                                class="py-2 px-4 flex justify-center items-center text-white dark:text-black bg-gray-900 hover:bg-theme dark:bg-slate-300  hover:text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none rounded-lg">
                                <svg width="20" height="20" fill="currentColor" class="hidden mr-2 animate-spin"
                                    viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M526 1394q0 53-37.5 90.5t-90.5 37.5q-52 0-90-38t-38-90q0-53 37.5-90.5t90.5-37.5 90.5 37.5 37.5 90.5zm498 206q0 53-37.5 90.5t-90.5 37.5-90.5-37.5-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm-704-704q0 53-37.5 90.5t-90.5 37.5-90.5-37.5-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm1202 498q0 52-38 90t-90 38q-53 0-90.5-37.5t-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm-964-996q0 66-47 113t-113 47-113-47-47-113 47-113 113-47 113 47 47 113zm1170 498q0 53-37.5 90.5t-90.5 37.5-90.5-37.5-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm-640-704q0 80-56 136t-136 56-136-56-56-136 56-136 136-56 136 56 56 136zm530 206q0 93-66 158.5t-158 65.5q-93 0-158.5-65.5t-65.5-158.5q0-92 65.5-158t158.5-66q92 0 158 66t66 158z">
                                    </path>
                                </svg>
                                <span>Soumettre</span>
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
                                <x-input-error :messages="$errors->get('designation')" class="mt-2" autocomplete="off" />
                                <x-text-input id="qte_demandee" autocomplete="off" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-[23.8%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" type="number" min="1" step="1" name="demandes[${i}][qte_demandee]" required autofocus autocomplete="off" placeholder="Ex. 10"/>
                                <x-input-error :messages="$errors->get('qte_demandee')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex justify-end mb-4">
                            <button type="button" class="delete-input text-white bg-slate-700 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-md p-2.5 text-center inline-flex items-center me-2 dark:bg-slate-600 dark:hover:bg-slate-900 dark:focus:ring-slate-800">
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
                $('#btn-submit svg').removeClass('hidden')
                $('#btn-submit span').text('Chargement')
                let isValid = true;
                var demandes = []
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
