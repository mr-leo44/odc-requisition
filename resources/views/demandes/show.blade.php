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
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th colspan="2" scope ="col" class="px-6 py-3">Service démandeur</th>
                    <th scope ="col" class="px-6 py-3"> Magasin </th>
                    <th scope ="col" class="px-6 py-3"> Responsable Moyens Généraux</th>
                    <th scope ="col" class="px-6 py-3"> Chef de Département Achat & Logistique</th>
                </tr>
                <tr>
                    <td scope ="col" class="px-6 py-3">User</td>
                    <td scope ="col" class="px-6 py-3">Manager</td>
                    <td colspan="3" scope ="col" class="px-6 py-3"></td>

                </tr>
            </thead>
            {{-- <tbody>       
                <tr>
                        
                    <td class="px-6 py-4">
                        {{ $demande->user->name }} <br/>
                        {{ $demande->status }} {{$demande->created_at}} 
                    </td>
                    @foreach ($approbateurs as $item)
                    <td class="px-6 py-4"> {{$item->name}} <br/>
                        {{$item->created_at}} <br/>
                        {{ $demande->status }}
                    </td>
                    </td>
                    @endforeach
                    
                </tr>
            </tbody> --}}
        </table>
    </div>
    <div style="display: flex; justify-content: flex-end; margin-top: 20%;">
        <button id="accept" onclick="accept(event);" data-modal-target="valider" data-modal-toggle="valider"  type="button"
            class="text-white bg-emerald-700 hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-black-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-black-600 dark:hover:bg-black-700 dark:focus:ring-black-800">
            Valider
        </button>
        <button id="reject" onclick="reject(event)" data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button"
            class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            Rejeter
        </button>
        <a href=""
            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Générer
            pdf</a>
    </div>

    <x-valider :demande="$demande" />
    <x-rejeter :demande="$demande" />
</x-app-layout>
