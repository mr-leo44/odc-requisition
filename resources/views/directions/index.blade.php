<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Directions') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div id="alert-3"
            class="flex items-center p-4 my-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
            </div>
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
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex justify-end my-4">
            <button type="button" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">ajouter</button>
        </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <form action="" method="post">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Numero
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Noms
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($directions as  $key => $direction)
                                    <tr  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $key+1 }}
                                        </th>
                                        </th>
                                        <td class="px-6 py-3">
                                            {{ $direction->name }}
                                        </td>
                                        <td class="flex space-x-7">
                                                <a href="{{ route('directions.destroy', $direction->id) }}"
                                                    onclick="supprimer(event);" 
                                                    data-modal-target="delete-modal"
                                                    data-modal-toggle="delete-modal"
                                                    >
                                                    <svg class="w-[34px] h-[34px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                                    </svg>
                                                </a>
                                                <a href="#"

                                                onclick="edit(event);"
                                                    data-modal-target="edit-modal" 
                                                    data-modal-toggle="edit-modal"
                                                    data-direction-id="{{ $direction->id }}"
                                                    data-direction-name="{{ $direction->name }}">
                                                    <svg class="w-[34px] h-[34px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                                    </svg>
                                                </a>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </form>
            
            </div>
    </div>
    <x-createDirection/>
    <x-deleteDirection :message="__('Voulez-vous  vraiment supprimer cette Direction ?')"/>
    <x-editDirection/>

</x-app-layout>
