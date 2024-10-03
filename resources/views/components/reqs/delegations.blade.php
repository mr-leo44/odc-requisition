<div class="hidden p-4 rounded-lg" id="styled-delegations" role="tabpanel" aria-labelledby="delegations-tab">
    <div class="flex gap-3 justify-between items-center mb-1">
        <div class="flex justify-between items-center">
            <button type="button" id="delegationsGridView"
                class="p-2.5 ms-2 ease-in-out transition-all duration-75 text-sm font-medium text-white bg-gray-400 hover:bg-gray-500 rounded-lg [&.active]:bg-gray-900 active">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.143 4H4.857A.857.857 0 0 0 4 4.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 10 9.143V4.857A.857.857 0 0 0 9.143 4Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 20 9.143V4.857A.857.857 0 0 0 19.143 4Zm-10 10H4.857a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286A.857.857 0 0 0 9.143 14Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286a.857.857 0 0 0-.857-.857Z" />
                </svg>
            </button>
            <button type="button" id="delegationsListView"
                class="p-2.5 ms-2 ease-in-out transition-all duration-75 text-sm font-medium text-white bg-gray-400 hover:bg-gray-500 rounded-lg [&.active]:bg-gray-900">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
                </svg>
            </button>
        </div>
    </div>
    @if ($delegations && $delegations->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 grid-cols-1 gap-3" id="delegationsCardGridView">
            @foreach ($delegations as $req)
                <div
                    class="block bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <div class="border-b dark:border-gray-600 p-4">
                        <div class="flex items-center justify-between">
                            <h5
                                class="mb-2 text-md md:text-xl xl:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $req->numero }}</h5>
                            <span
                                class="font-medium text-sm text-gray-700 dark:text-gray-400">{{ $req->created_at->locale('fr')->diffForHumans() }}</span>
                        </div>
                        <p class="font-medium text-md text-gray-700 dark:text-white">{{ $req->user->name }}</p>
                        <p class="font-medium text-md text-gray-700 dark:text-white">{{ $req->service }}</p>
                        <p class="font-medium text-md text-gray-700 dark:text-white">{{ $req->user->compte->city }}</p>
                    </div>
                    <div class="flex justify-end items-center ml-auto p-4">
                        <div class="flex justify-end items-center gap-2">
                            <button data-modal-target="show-modal" data-modal-toggle="show-modal" type="button"
                                class="bg-gray-600 dark:hover:bg-gray-800 px-3 py-2 rounded" onclick="showModal({{ $req }})">
                                <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="grid grid-cols-1" id="delegationsCardGridView">
            <div class="block bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-center py-10 text-lg">
                    @profile('livraison')
                        {{ __('Pas de demande de livraison en cours!') }}
                    @endprofile
                    @profile('user')
                        {{ __('Pas de demande en cours!') }}
                    @endprofile
                </div>
            </div>
        </div>
    @endif
        <head>
            <script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
        </head>
    <div class="hidden text-gray-900 overflow-x-auto dark:text-white" id="delegationsCardListView">
        <table id="delegationTab" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs uppercase bg-slate-100 dark:bg-transparent text-black dark:text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        N°
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Numéro Requisition
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Demandeur
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Service
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ville
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-right">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800">
                    @foreach ($delegations as $key => $req)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $key + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $req->numero }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $req->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $req->service }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $req->user->compte->city }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $req->created_at->locale('fr')->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                                <button data-modal-target="show-modal" data-modal-toggle="show-modal" type="button"
                                class="bg-gray-600 dark:hover:bg-gray-800 px-3 py-2 rounded" onclick="showModal({{ $req }})">
                                <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    <style>
    div.dt-container .dt-search{
        display: flex;
        justify-content: flex-end;
        margin: 24px;
    }
    div.dt-container .dt-search input {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: transparent;
    color: inherit;
    margin-left: 3px;
    }

    div.dt-container .dt-input {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: transparent;
    color: inherit;
    
    }

    div.dt-container select.dt-input {
    padding: 4px;
    }
    div.dt-container .dt-info{
        display: none;
    }

</style>
</div>
<script>
    new DataTable("#delegationTab", {
        paging: false,
        sortable: false
    });

    const div = document.querySelector('.dt-search label');
    const label = document.querySelector('label[for="dt-search-0"]')
    const Search = document.querySelector('.dt-input')
    label.classList.add('sr-only');
    var text = document.querySelector('.dt-empty');
</script>

<script>
    const delegationsListView = document.getElementById("delegationsListView");
    const delegationsGridView = document.getElementById("delegationsGridView");
    const delegationsCardGridView = document.getElementById("delegationsCardGridView");
    const delegationsCardListView = document.getElementById("delegationsCardListView");
    delegationsListView.addEventListener("click", function() {
        localStorage.setItem('delegationsViewMode', 'delegationsList')
        toggleDelegationsView()
    });
    delegationsGridView.addEventListener("click", function() {
        localStorage.setItem('delegationsViewMode', 'delegationsGrid')
        toggleDelegationsView()
    });

    function toggleDelegationsView() {
        const delegationsViewMode = localStorage.getItem('delegationsViewMode')
        if (delegationsViewMode === 'delegationsList') {
            delegationsGridView.classList.remove("active");
            delegationsCardGridView.classList.add("hidden");
            delegationsListView.classList.add("active");
            delegationsCardListView.classList.remove("hidden");
            delegationsCardListView.classList.add("active");
        } else {
            delegationsListView.classList.remove("active");
            delegationsCardListView.classList.add("hidden");
            delegationsGridView.classList.add("active");
            delegationsCardGridView.classList.remove("hidden");
            delegationsCardGridView.classList.add("active");
        }
    }
    toggleDelegationsView()
 
</script>