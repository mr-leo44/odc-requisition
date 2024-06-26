
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Historique des demandes') }}
        </h2>
    </x-slot>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        N°DEMANDE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        SERVICE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        UTILISATEUR
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ACTION
                    </th>
                    <th scope="col" class="px-6 py-3">
                        DATE DE CREATION
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($demandes as $demande)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $demande->numero }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $demande->service->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $demande->user->name }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('demandes.show', $demande->id) }}"
                                class=" bg-blue-500 px-10 py-1 text-white rounded">Voir</a>
                        </td>
                        <td class="px-6 py-4">
                            {{ $demande->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $demandes->links() }}

        {{-- <x-showDemande :demande="$demande" /> --}}
        <x-createDemande />
        <x-deleteDemande />
    </div>

</x-app-layout>
