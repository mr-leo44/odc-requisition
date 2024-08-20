<x-app-layout>
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
                        <th scope="col" class="px-6 py-3">Service</th>
                        <th scope="col" class="px-6 py-3">Users</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                        <th scope="col" class="px-6 py-3">Date de création</th>
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
                                <a href="{{ route('demandes.show', $demande->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                                    Voir
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                {{ ucfirst($demande->created_at->locale('fr')->isoFormat('LLLL')) }}
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
                searchPlaceholder: "Rechercher dans l'historique...",
                paginate: {
                    previous: "Précédent",
                    next: "Suivant"
                }
            },
            lengthChange: false, // Désactive la sélection du nombre d'éléments par page
        });
    </script>
</x-app-layout>
