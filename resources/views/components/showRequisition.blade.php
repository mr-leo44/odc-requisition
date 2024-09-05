@props(['req'])
<div id="show-req-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative max-w-5xl mx-auto p-6 w-full max-h-full">
        <div class="max-w-4xl mx-auto relative bg-white rounded-lg shadow dark:bg-gray-800">
            <button type="button" id="closeBtn"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="show-req-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5">
                <div class="my-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Demande de requisition
                        {{ $req->numero }}</h3>
                    <p class="font-medium">Demandeur : {{ $req->user->name }}</p>
                    <p class="font-medium">Service : {{ $req->service }}</p>
                </div>
                <div class="my-8 rounded dark:bg-gray-700 dark:border-gray-600 p-4">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs  uppercase bg-slate-100 dark:bg-transparent text-black dark:text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Designation
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantité demandee
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantite livree
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    date
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900">
                            </head>

                            @foreach ($req->demande_details as $detail)
                                <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $detail->designation }}
                                    </th>
                                    <td class="px-6 py-4 text-right">
                                        {{ $detail->qte_demandee }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        {{ $detail->qte_livree }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ ucfirst($detail->created_at->locale('fr')->isoFormat('LLLL')) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-8 flex justify-end items-center">
                        @profile('user')
                            @if ($req->status === 'en cours')
                                <button id="accept" onclick="accept(event);" data-modal-target="valider"
                                    data-modal-toggle="valider" type="button"
                                    class="text-white bg-emerald-700 hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-black-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-black-600 dark:hover:bg-black-700 dark:focus:ring-black-800">
                                    Valider
                                </button>
                                <button id="reject" onclick="reject(event)" data-modal-target="popup-modal"
                                    data-modal-toggle="popup-modal" type="button"
                                    @if ($req->status === 'rejeté') class="hidden" @endif
                                    class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                    Rejeter
                                </button>
                            @endif
                        @endprofile
                        @profile('livraison')
                            <a data-modal-target="default-modal" id="deliver" data-modal-toggle="default-modal"
                                data-modal-hide="show-req-modal"
                                class="bg-red-600 px-3 py-2 rounded ease-in-out transition-all duration-75">
                                <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                                </svg>
                            </a>
                        @endprofile
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@profile('livraison')
    <x-show-livraison :details="$req->demande_details" />
@endprofile
<script>
    
    
</script>
