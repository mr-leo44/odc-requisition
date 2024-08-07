<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="w-full mb-2 lg:m-0">
                <div class="grid grid-cols-3 gap-3">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg col-span-2 mb-3">
                        <h2 class="text-2xl lg:text-3xl my-3 font-bold text-gray-900 dark:text-white">
                            {{ $user->name }}</h2>
                        {{-- <h5>@username</h5> --}}
                        <div class="flex gap-2 text-md lg:text-xl font-medium text-gray-900 dark:text-white">
                            <svg class="w-6 h-6 lg:w-8 lg:h-8 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                            </svg>
                            <p>{{ $user->compte->service }} /
                                {{ $user->compte->direction->name }}</p>
                        </div>
                        <div class="flex gap-2 mt-2 text-md lg:text-xl font-medium text-gray-900 dark:text-white">
                            <svg class="w-6 h-6 lg:w-8 lg:h-8 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                            </svg>

                            <p>{{ $user->email }}</p>
                        </div>
                        <p class="flex gap-2 text-md lg:text-xl font-medium text-gray-900 dark:text-white">
                            @if ($user->manager !== $user->name)
                                Manager : {{ $user->manager }}
                            @endif
                        </p>
                    </div>
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-3">
                        <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Manager') }}
                        </h2>
                        <p class="mt-1 text-xl text-gray-600 dark:text-gray-400">
                            @if ($user->manager === $user->name)
                                {{ __('Moi') }}
                            @else
                                {{ $user->manager }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div
                        class="p-2 sm:p-8 bg-white dark:bg-gray-800 text-gray-800 dark:text-white shadow sm:rounded-lg">
                        <div class="flex justify-between items-center p-2">
                            <div class="my-2">
                                <span class="text-xl lg:text-2xl font-medium">Mes demandes</span>
                            </div>
                            <div
                                class="flex w-11 h-11 lg:w-16 lg:h-16 items-center justify-center bg-slate-600 rounded-full">
                                <svg class="w-6 h-6 lg:w-8 lg:h-8 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 3v4a1 1 0 0 1-1 1H5m4 10v-2m3 2v-6m3 6v-3m4-11v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 p-2 flex items-end justify-between text-gray-800 dark:text-white">
                            <h4 class="text-2xl lg:text-3xl font-bold text-black dark:text-white">
                                {{ $user->demandes->count() }}
                            </h4>
                        </div>
                    </div>
                    <div
                        class="p-2 sm:p-8 bg-white dark:bg-gray-800 text-gray-800 dark:text-white shadow sm:rounded-lg">
                        <div class="flex justify-between items-center p-2">
                            <div class="my-2">
                                <span class="text-xl lg:text-2xl font-medium">Demandes du mois</span>
                            </div>
                            <div
                                class="flex w-11 h-11 lg:w-16 lg:h-16 items-center justify-center bg-slate-600 rounded-full">
                                <svg class="w-6 h-6 lg:w-8 lg:h-8 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 p-2 flex items-end justify-between text-gray-800 dark:text-white">
                            <h4 class="text-2xl lg:text-3xl font-bold text-black dark:text-white">
                                {{ $user->this_month_req }}
                            </h4>
                            <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
                                @if ($user->last_month_req < $user->this_month_req)
                                    <svg class="w-6 h-6 lg:w-10 lg:h-10 text-emerald-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4" />
                                    </svg>
                                @elseif ($user->last_month_req > $user->this_month_req)
                                    <svg class="w-6 h-6 lg:w-10 lg:h-10 text-red-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 19V5m0 14-4-4m4 4 4-4" />
                                    </svg>
                                @else
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md my-4">
                    <h2 class="text-xl font-medium text-gray-900 my-4 dark:text-gray-100">
                        {{ __('Mes Collaborateurs') }}
                    </h2>
                    <table
                        class="w-full text-md text-center rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    N°
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nom
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Demandes
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Demandes du mois
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($collaborateurs->count() > 0)
                                @foreach ($collaborateurs as $key => $collaborateur)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $key + 1 }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $collaborateur->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $collaborateur->recent_reqs }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $collaborateur->collab_last_reqs }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 text-center text-md lg:text-lg" colspan="4">
                                        {{ __('Pas de collaborateurs') }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    </div>
    </div>
</x-app-layout>
