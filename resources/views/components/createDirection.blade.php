@props(['directions'])
<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true"
    class="hidden mx-auto overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center max-w-2xl md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-5xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Création d'une direction
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
                    <form class="w-full" action="{{ route('directions.store') }}" method="POST">
                        @csrf
                        <div id="input-container">
                            <div class="grid gap-4 mb-6 md:grid-cols-6">
                                <div class="col-span-5">
                                    <div class="grid gap-32 grid-cols-3">
                                        <div class="col-span-2">
                                            <x-input-label
                                                class="flex-start font-bold block mb-2 text-sm text-gray-900 dark:text-white"
                                                for="name" :value="__('Please enter your Direction')" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid gap-4 mb-6 md:grid-cols-6 input-group ">
                                <div class="col-span-5">
                                    <div class="flex justify-between gap-3">
                                        <x-text-input id="name"
                                            class="bg-gray-50 w-[80%] border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                            type="text" name="name" :value="old('name')"
                                            placeholder="Nom " required autofocus
                                            autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        <button type="submit" class="block text-white bg-orange-500 focus:ring-4 focus:outline-none font-bold rounded-lg text-sm px-10 text-center">
                                        Soumettre
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

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
