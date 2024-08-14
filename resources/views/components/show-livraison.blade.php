@props(['details'])
<!-- Main modal -->
@if ($errors->any())
    <div class="bg-red-500 text-white px-3 py-2 rounded-lg mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('demandes.updateLivraison') }}" method="POST">
    @csrf

    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Mise à jour de la livraison
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->


                <div class="p-4 md:p-5 space-y-4">
                    {{-- @if ($allDelivered)
                        <div class="bg-green-500 text-white px-3 py-2 rounded-lg mb-4">
                            Toutes les demandées ont été complètement livrées
                        </div>
                    @endif --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>

                                    <th scope ="col" class="px-6 py-3">
                                        Désignation
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantité demandée
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantité livrée
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantité à livrer
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                                @foreach ($details as $key => $detail)
                                    @if ($detail->qte_demandee != $detail->qte_livree)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">
                                            {{ $detail->designation }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $detail->qte_demandee }}
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $detail->qte_livree }}
                                        </td>


                                        <div>
                                            <input type="hidden" name="details[{{ $key }}][id]"
                                                value="{{ $detail->id }}" id="details[{{ $key }}][id]"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Ex.10" required />
                                        </div>


                                        <td class="px-6 py-4">

                                            <div class="flex justify-between gap-3">
                                                <x-text-input id="quantite_{{ $key }}"
                                                    class="bg-gray-50 w-[80%] border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                                    type="text" name="details[{{ $key }}][quantite]"
                                                    max="{{ $detail->qte_demandee }}" :value="old('quantite')"
                                                    placeholder="Ex. 12" required autofocus autocomplete="quantite"
                                                    oninput="validateInput({{ $key }}, {{ $detail->qte_demandee }})" />
                                                <x-input-error :messages="$errors->get('quantite')" class="mt-2" />


                                                <div id="error_{{ $key }}" class="text-red-500 text-sm">
                                                </div>

                                        </td>
                                    </tr>
                                    @endif
                                @endforeach


                            </tbody>

                        </table>
                    </div>

                    {{-- </div> --}}



                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button id="submitBtn" type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            style="margin-left: auto;" disabled>Mettre à jour</button>
                    </div>
                </div>
            </div>
        </div>
</form>

<script>
    function validateInput(key, max) {
        const input = document.getElementById(`quantite_${key}`);
        const error = document.getElementById(`error_${key}`);
        const submitBtn = document.getElementById('submitBtn');
        let isValid = true;

        if (!input.value) {
            error.textContent = 'Ce champ doit être rempli';
            isValid = false;
        } else if (parseInt(input.value) > max) {
            error.textContent = `La valeur ne doit pas dépasser ${max}`;
            isValid = false;
        } else {
            error.textContent = '';
        }

        const allInputs = document.querySelectorAll('input[type="text"]');
        allInputs.forEach(input => {
            if (!input.value || parseInt(input.value) > max) {
                isValid = false;
            }
        });

        submitBtn.disabled = !isValid;
    }
</script>
