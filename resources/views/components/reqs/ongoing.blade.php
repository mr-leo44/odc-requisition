<div class="hidden p-2 rounded-lg" id="styled-ongoing" role="tabpanel" aria-labelledby="ongoing-tab">

    <div class="flex gap-3 justify-between items-center mb-1">
        <head>
            <script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
        </head>
    </div>
    <div class="flex gap-3 justify-between items-center mb-1">
        <div class="flex justify-between items-center">
            <button type="button" id="ongoingGridView"
                class="p-2.5 ms-2 ease-in-out transition-all duration-75 text-sm font-medium text-white bg-gray-900 hover:bg-gray-500 rounded-lg [&.active]:bg-theme">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.143 4H4.857A.857.857 0 0 0 4 4.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 10 9.143V4.857A.857.857 0 0 0 9.143 4Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 20 9.143V4.857A.857.857 0 0 0 19.143 4Zm-10 10H4.857a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286A.857.857 0 0 0 9.143 14Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286a.857.857 0 0 0-.857-.857Z" />
                </svg>
            </button>
            <button type="button" id="ongoingListView"
                class="p-2.5 ms-2 ease-in-out transition-all duration-75 text-sm font-medium text-white bg-gray-900 hover:bg-gray-500 rounded-lg [&.active]:bg-theme">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
                </svg>
            </button>
        </div>
        <div class="flex justify-between items-center gap-3">
            <button type="button" @if (Session::get('authUser')->compte->role->value === 'livraison') class="hidden" @endif
                data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                class="p-2.5 ms-2 ease-in-out transition-all duration-75 text-sm font-medium text-white bg-gray-900 active:bg-theme dark:active:bg-theme hover:bg-theme rounded-lg ">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
            </button>
        </div>
    </div>
    @if ($ongoings->count() > 0)
    <hr class="h-px my-3 bg-transparent border-0 dark:bg-transparent">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 grid-cols-1 gap-3" id="ongoingCardGridView">
            @foreach ($ongoings as $req)
                <div
                    class="block bg-white border border-gray-200 rounded-lg shadow-xl p-8 transform transition-transform duration-300 hover:scale-105 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <div class="border-b dark:border-gray-600 p-4  ">
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
                                class="bg-gray-900 active:bg-gray-600 dark:active:bg-gray-600 hover:bg-theme dark:hover:bg-theme px-3 py-2 rounded" onclick="showModal({{ $req }})">
                                <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            @if (session()->get('authUser')->id == $req->user_id && $req->level === 0)
                                <a onclick="supprimer(event);" data-modal-target="delete-modal"
                                     href="{{ route('demandes.destroy', $req->id) }}" id="gridDelete"
                                    data-modal-toggle="delete-modal"
                                    class="bg-red-600 hover:bg-red-800 px-3 py-2 rounded">
                                    <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="grid grid-cols-1" id="ongoingCardGridView">
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


    <div class="hidden text-gray-900 overflow-x-auto dark:text-white" id="ongoingCardListView">
        <table id="ongoingData" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                    @foreach ($ongoings as $key => $req)
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
                                    class="bg-gray-900 active:bg-gray-600 dark:active:bg-gray-600 hover:bg-theme  px-3 py-2 rounded" onclick="showModal({{ $req }})">
                                    <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                @if (session()->get('authUser')->id == $req->user_id && $req->level === 0)
                                    <a onclick="supprimer(event);" data-modal-target="delete-modal" id="tableDelete"
                                        href="{{ route('demandes.destroy', $req->id) }}"
                                        data-modal-toggle="delete-modal"
                                        class="bg-red-700 active:bg-theme dark:active:bg-theme hover:bg-red-800   dark:hover:bg-red-800 px-3 py-2 rounded">
                                        <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>

<x-deleteDemande />


<script>
    new DataTable('#ongoingData',{
        paging: false,
        sortable: false
    })

    const div = document.querySelector('.datatable-search');
    const Search = document.querySelector('.datatable-input');

    Search.placeholder ="Recherche ...";

</script>

<script>
    const ongoingListView = document.getElementById("ongoingListView");
    const ongoingGridView = document.getElementById("ongoingGridView");
    const ongoingCardGridView = document.getElementById("ongoingCardGridView");
    const ongoingCardListView = document.getElementById("ongoingCardListView");
    ongoingListView.addEventListener("click", function() {
        localStorage.setItem('ongoingViewMode', 'ongoingList')
        toggleOngoingView()
    });
    ongoingGridView.addEventListener("click", function() {
        localStorage.setItem('ongoingViewMode', 'ongoingGrid')
        toggleOngoingView()
    });

    function toggleOngoingView() {
        const ongoingViewMode = localStorage.getItem('ongoingViewMode')
        if (ongoingViewMode === 'ongoingList') {
            ongoingGridView.classList.remove("active");
            ongoingCardGridView.classList.add("hidden");
            ongoingListView.classList.add("active");
            ongoingCardListView.classList.remove("hidden");
            ongoingCardListView.classList.add("active");
        } else {
            ongoingListView.classList.remove("active");
            ongoingCardListView.classList.add("hidden");
            ongoingGridView.classList.add("active");
            ongoingCardGridView.classList.remove("hidden");
            ongoingCardGridView.classList.add("active");
        }
    }
    toggleOngoingView()



</script>
