<div class="hidden p-4 rounded-lg" id="styled-collaborators" role="tabpanel" aria-labelledby="collaborators-tab">
    <div class="flex gap-3 justify-between items-center mb-1">
        <head>
            <script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
        </head>
    </div>
    <div class="text-gray-900 overflow-x-auto dark:text-white" id="collaboratorsCardListView">
        <table id="collabTab" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                    @foreach ($collaborators as $key => $req)
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
                                {{ $req->user->compte->city }}
                            <td class="px-6 py-4">
                                {{ $req->created_at->locale('fr')->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                                <button data-modal-target="show-modal" data-modal-toggle="show-modal" type="button"
                                    class="bg-gray-900 active:bg-gray-600 dark:active:bg-gray-600 hover:bg-theme dark:hover:bg-gray-800 px-3 py-2 rounded"
                                    onclick="showModal({{ $req }})">
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
        @if ($collaborators)
            <div class="px-6 py-3 my-4">{{ $collaborators->links() }}</div>
        @endif
    </div>
</div>
<script>

          new DataTable("#collabTab", {
        paging: false,
        sortable: false
    });
    const div1 = document.querySelector('.datatable-search');
    const Search2 = document.querySelector('.datatable-input');
    Search.placeholder ="Recherche ...";
</script>
