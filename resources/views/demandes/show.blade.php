<x-app-layout>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Demandes') }}
                </h2>
            </x-slot>




            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>

                    <th scope ="col" class="px-6 py-3">
                        Désignation
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantité demandée
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantitée livrée
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($demande->demande_details as $detail)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <td class="px-6 py-4">
                            {{ $detail->designation }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $detail->qte_demandee }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $detail->qte_livree }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



</x-app-layout>
