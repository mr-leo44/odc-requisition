<x-app-layout>
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded ">
        <div class="rounded-t mb-0 px-4  border-0">
            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class=" font-bold text-base dark:text-white">Historics</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <head>
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
        <!-- DataTables JS -->
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    </head>
    <div class="bg-white dark:bg-gray-900 p-4 shadow-md sm:rounded-lg">
        <div class="overflow-x-auto">
            <table id="example" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">N°</th>
                        <th scope="col" class="px-6 py-3">Services</th>
                        <th scope="col" class="px-6 py-3">Users</th>
                        <th scope="col" class="px-6 py-3">Creation Date</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900">
                    @foreach ($demandes as $demande)
                    <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $demande->numero }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $demande->service }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $demande->user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ ucfirst($demande->created_at->locale('fr')->isoFormat('LLLL')) }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('demandes.show', $demande->id) }}"
                                class="py-1 px-4">
                                <i class="material-icons-outlined text-black dark:text-white hover:text-orange-500">visibility</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $demandes->links() }}
        </div>
        <x-createDemande />
        <x-deleteDemande />
    </div>
    <script>
        new DataTable('#example', {
            info: false,
            ordering: true,
            paging: true,
            pageLength: {{ $demandes->perPage() }},
            language: {
                searchPlaceholder: "Search...",
                paginate: {
                    previous: "Précédent",
                    next: "Suivant"
                }
            },
            lengthChange: false, // Désactive la sélection du nombre d'éléments par page
        });
    </script>
</x-app-layout>