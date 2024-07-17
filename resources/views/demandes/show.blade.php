<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Demandes') }}
            </h2>
        </x-slot>

        <head>
            <!-- DataTables CSS -->
            <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
            <!-- DataTables JS -->
            <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
        </head>

        <table id="example" class="w-full text-sm text-left rtl:text-right my-2 text-gray-500 dark:text-gray-400">
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
                    <th colspan="2" scope="col" class="px-6 py-3 text-center">
                        <span class="block font-semibold lg:text-sm">Service</span>
                        <span class="font-normal">{{ $demande->service->name }}</span>
                    </th>
                    @foreach ($demande->approbateurs as $key => $approbateur)
                        <th scope="col" class="px-6 py-3 text-center">{{ $approbateur->fonction }}</th>
                    @endforeach
                </tr>
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <td scope="col" class="px-6 py-3 text-center">
                        <span class="block font-semibold">Utilisateur</span>
                        <span class="font-normal">{{ $demande->user->name }}</span>
                    </td>
                    <td scope="col" class="px-6 py-3 text-center">
                        <span class="block font-semibold">Manager</span>
                        <span class="font-normal">{{ $demande->manager->name }}</span>
                    </td>
                    @foreach ($demande->approbateurs as $key => $approbateur)
                        <td scope="col" class="px-6 py-3 text-center">{{ $approbateur->name }}</th>
                    @endforeach

                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-gray-700">
                    @foreach ($traitements as $key => $traitement)
                        @if ($traitement->status == 'validé')
                            <td scope="col" class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <svg class="h-6 text-emerald-600 w-full mx-auto dark:text-emerald-600"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </td>
                        @elseif($traitement->status == 'rejeté')
                            <td scope="col" class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <svg class="h-6 text-red-600 w-full mx-auto dark:text-red-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </td>
                        @else
                            <td scope="col" class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <span class="w-full mx-auto">{{ __(' ') }}</span>

                            </td>
                        @endif
                    @endforeach
                </tr>

                <tr>
                    @foreach ($traitements as $key => $traitement)
                        @if ($traitement->status === 'en cours')
                            <td scope="col" class="px-6 py-4 text-center hover:bg-gray-50 dark:hover:bg-gray-600">
                                {{ __(' ') }}</td>
                        @else
                            <td scope="col" class="px-6 py-4 text-center hover:bg-gray-50 dark:hover:bg-gray-600">
                                {{ $date_validate[$key] }}</td>
                        @endif
                    @endforeach

                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex justify-end mt-4">
        @if ($en_cours->approbateur_id === session()->get('authUser')->id && $en_cours->status === 'en cours')
            <button id="accept" onclick="accept(event);" data-modal-target="valider" data-modal-toggle="valider"
                type="button"
                class="text-white bg-emerald-700 hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-black-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-black-600 dark:hover:bg-black-700 dark:focus:ring-black-800">
                Valider
            </button>
            <button id="reject" onclick="reject(event)" data-modal-target="popup-modal"
                data-modal-toggle="popup-modal" type="button" @if ($en_cours->status === 'rejeté') class="hidden" @endif
                class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Rejeter
            </button>
        @endif
        @if ($en_cours->status != 'en cours' && $en_cours->demandeur_id === session()->get('authUser')->id)
            <form action="{{ route('generate', $demande) }}" method="post">
                @csrf
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Générer
                    pdf
                </button>
            </form>
        @endif
    </div>

    <x-valider :demande="$demande" />
    <x-rejeter :demande="$demande" />

    <script>
        new DataTable('#example', {
            info: true,
            ordering: false,
            paging:true ,


        });
    </script>
</x-app-layout>
