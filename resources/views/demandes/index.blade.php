<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div id="alert-3"
                    class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
            <div class="max-h-auto mx-auto container">
                <div class="relative sm:flex sm:justify-center sm:items-center selection:text-white">
                    <div class="max-w-7xl mx-auto p-6 lg:p-8">
                        <div class="flex justify-center font-semibold text-4xl">
                            <h1>
                                {{-- Liste des demandes --}}
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <div class="flex justify-end my-2">
                        {{-- <a href="{{ route('demandes.create') }}" data-toggle="modal" data-target="#ModalCreate"
                            class="bg-indigo-700 px-6 py-1 text-white rounded">Nouveau</a> --}}
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            Ajouter
                        </button>
                    </div>
                    <table class="max-w-7xl max-h-full w-full">
                        <thead class="dark:hover:bg-gray-700 group">
                            <tr>
                                <th scope="col"
                                    class="text-sm font-medium bg-indigo-100 text-indigo-900 px-6 py-4 text-left">
                                    N° Demande
                                </th>
                                <th scope="col"
                                    class="text-sm font-medium bg-indigo-100 text-indigo-900 px-6 py-4 text-left">
                                    Service
                                </th>
                                <th scope="col"
                                    class="text-sm font-medium bg-indigo-100 text-indigo-900 px-6 py-4 text-left">
                                    Utilisateur</th>
                                <th scope="col"
                                    class="text-sm font-medium bg-indigo-100 text-indigo-900 px-6 py-4 text-left">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($demandes as $demande)
                                <tr class="dark:bg-gray-800">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-gray-400">
                                        {{ $demande->numero }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-gray-400">
                                        {{ __('Marketing') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-gray-400">
                                        {{ $demande->user->name }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-900 first:mr-2 last:ml-2">
                                        <a href="{{ route('demandes.show', $demande->id) }}"
                                            class="bg-blue-700 px-6 py-1 text-white rounded">Voir</a>
                                        <a href="{{ route('demandes.edit', $demande->id) }}"
                                            class="bg-emerald-700 px-6 py-1 text-white rounded">Editer</a>
                                        <form action="{{ route('demandes.destroy', $demande->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-700 px-6 py-1 text-white rounded">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $demandes->links() }}
            </div>
            {{-- @include('demandes.modal.create') --}}
            <!-- Main modal -->
            <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                class="hidden mx-auto overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center max-w-7xl md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-5xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Initier une demande
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="authentication-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                                        <div class="grid gap-3 mb-6 md:grid-cols-3 input-group">
                                            <div>
                                                <x-input-label
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                    for="designation" :value="__('Designation')" />
                                                <x-text-input id="designation"
                                                    class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    type="text" name="demandes[0][designation]" :value="old('designation')"
                                                    placeholder="Ex. Rame papier duplicataire" required autofocus
                                                    autocomplete="designation" />
                                                <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                                            </div>
                                            <div>
                                                <x-input-label
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                    for="qte_demandee" :value="__('Quantité')" />
                                                <x-text-input id="qte_demandee"
                                                    class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    type="number" name="demandes[0][qte_demandee]" :value="old('qte_demandee')"
                                                    required autofocus autocomplete="qte_demandee" />
                                                <x-input-error :messages="$errors->get('qte_demandese')" class="mt-2" />

                                            </div>

                                            <div>
                                                <x-input-label
                                                    class="block mb-9 text-sm font-medium text-gray-900 dark:text-white" />

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
                                        <x-input-label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            for="designation" :value="__('Designation')" />
                                        <x-text-input id="designation"
                                            class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            type="text" name="demandes[${i}][designation]" :value="old('designation')"
                                            placeholder="Ex. Rame papier duplicataire" required autofocus
                                            autocomplete="designation" />
                                        <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            for="qte_demandee" :value="__('Quantité')" />
                                        <x-text-input id="qte_demandee"
                                            class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            type="number" name="demandes[${i}][qte_demandee]" :value="old('qte_demandee')" required
                                            autofocus autocomplete="qte_demandee" />
                                        <x-input-error :messages="$errors->get('qte_demandee')" class="mt-2" />
                                    </div>

                                    <div>
                                            <x-input-label class="block mb-9 text-sm font-medium text-gray-900 dark:text-white"/>

                                            <a href="#" class="delete-input text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Supprimer</a>

                                            </div>

                                </div>
                            `);
                                });
                                // Ajout de la fonction de suppression
                                $(document).on('click', '.delete-input', function(e) {
                                    e.preventDefault();
                                    $(this).closest('.input-group').remove();
                                });
                            });

                            $(document).ready(function() {
                                $('.cancelButton').click(function(e) {
                                    e.preventDefault();
                                    // Effacer les champs de saisie
                                    $('#designation').val('');
                                    $('#qte_demandee').val('');
                                });
                            });

                        </script>

                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
