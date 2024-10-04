@props(['delegations','users','usersList'])
<div class="hidden p-4 rounded-lg" id="styled-delegation" role="tabpanel" aria-labelledby="delegation-tab">
    <div>
        @if (session()->has('delegation'))
            <div id="approvers-success-message"
                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('delegation') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-2.5 -my-2.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#approvers-success-message" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class=" w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        @if (session()->has('error'))
            <div id="alert-3"
                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session()->get('error') }}
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-3" aria-label="Close">
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

    <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
        <div class="flex justify-end my-2 space-x-1">
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" onclick="a(event)" type="button">
                <svg class="w-[44px] h-[44px] text-[#ff7900]" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
    <div class="sm:rounded-lg">
        <div class="overflow-x-auto">
            <table  class="w-full  dark:bg-white text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-400">
                     <tr class="">
                        <th scope="col" class="px-6 py-3">
                            N°
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Délégués
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Motifs
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Délégants
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date début
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date fin
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Statut
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900">
                     @foreach ($delegations as  $key => $delegation)

                                    <tr  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $key+1 }}
                                        </th>
                                        </th>
                                        <td class="py-3 px-6">
                                            {{ $delegation->user->name }}
                                        </td>
                                        <td class="py-3 px-6">
                                            {{$delegation->motif}}
                                        </td>
                                        <td class="py-3 px-6">
                                        @if ( $delegation->approbateur_name === $delegation->manager_name)
                                            {{$delegation->approbateur_name}}
                                        @else
                                            {{$delegation->approbateur_name}}
                                            {{$delegation->manager_name}}
                                        @endif
                                        </td>
                                        <td class="px-3 py-6">
                                            {{$delegation->date_debut}}
                                        </td>
                                        <td class="px-3 py-6">
                                            {{$delegation->date_fin}}
                                        </td>
                                        <td class="">
                                            @if ($delegation->status === 1)
                                            <span
                                                class="opacity-95 border-green-400 border text-green-500 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
                                                <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                                                </svg>
                                                En cours
                                            </span>
                                                @else
                                                <span
                                                class="opacity-95 border-red-400 border text-red-500 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
                                                <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                                                </svg>
                                                Terminé
                                            </span>
                                            @endif

                                        </td>
                                        <td>
                                            <a
                                                href="{{route('delegations.destroy', $delegation->id)}}"
                                                onclick="delegue(event)"
                                                data-modal-target="modal-del"
                                                data-modal-toggle="modal-del"
                                                data-id="{{$delegation->id}}"
                                                class="flex justify-center items-center"
                                                >
                                                <svg class="w-[33px] h-[33px] text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                                </svg>
                                            </a>


                                        </td>
                                </tr>
                        @endforeach
                </tbody>
            </table>
        </div>

        </div>
</div>
    <x-deleteDelegue :delegations="$delegations"/>
    <x-createDelegue :users="$users" :usersList="$usersList"/>
</div>

