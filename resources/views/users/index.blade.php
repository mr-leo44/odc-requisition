<x-app-layout>

    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded ">
        <div class="rounded-t mb-0 px-4  border-0">
            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class=" font-bold text-base dark:text-white">Users ({{ $users->count() }})</h3>
                    </div>
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                        <div class="flex justify-end my-2 space-x-1">
                            <button data-modal-target="modal" data-modal-toggle="modal" type="button">
                                <i class="material-icons-outlined text-green-400 font-bold text-xl">add</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto sm:px-6 lg:px-8">
        @if ($errors->any())
            <div id="error-message"
                class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    @foreach ($errors->all() as $error)
                    <ul>
                        <li>{{$error }}</li>
                    </ul>
                    @endforeach
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#error-message" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        @if (session('success'))
            <div id="success-message"
                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#success-message" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
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
                        <th scope="col" class="px-6 py-3">
                            N°
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Names
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Emails
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Roles
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Actions
                        </th>

                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900">
                    @if ($users->count() > 0)
                        @foreach ($users as $key => $user)
                            <tr
                                class="bg-white  border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $key + 1 }}
                                </th>
                                <td class="px-6 py-3">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-3">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-3">
                                    {{ $user->compte->role->value }}
                                </td>
                                <td class="flex justify-center items-center gap-2 px-6 py-3">
                                    <button type="button" onclick="changeRole(event, {{ $user }})"
                                        title="Changer rôle" data-modal-target="change-role"
                                        data-modal-toggle="change-role">
                                        <i class="material-icons-outlined text-black dark:text-white">
                                            manage_accounts
                                        </i>
                                    </button>
                                    <form action="{{ route('users.activation', $user) }}" method="post">
                                        @csrf
                                        @if ($user->compte->is_activated === 0)
                                            <button type="submit" title="Activer">
                                                <i class="material-icons-outlined text-red-500">
                                                    toggle_off
                                                </i>
                                            </button>
                                        @else
                                            <button type="submit" title="Désactiver">
                                                <i class="material-icons-outlined text-green-500">
                                                    toggle_on
                                                </i>
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center px-6 py-4">
                                {{ __('Aucun utilisateur se trouve dans cette application') }}
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="my-3 px-6">
            {{ $users->links() }}
        </div>
    </div>
    @if ($users->count() > 0)
        <x-change-role :user="$user" />
    @endif
    <x-user-create :users="$usersList" :directions="$directions" :services="$services" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        new DataTable('#example', {
            info: false,
            ordering: true,
            paging: true,
            pageLength: {{ $users->perPage() }},
            language: {
                // searchPlaceholder: "Rechercher",
                paginate: {
                    previous: "Précédent",
                    next: "Suivant"
                }
            },
            lengthChange: false, // Désactive la sélection du nombre d'éléments par page
        });
    </script>

</x-app-layout>
