<div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Annulation d'une demande</h3>
                <p class="mb-3 lg:text-xs text-gray-700 dark:text-gray-200">Ne valider qu'une fois sûr!</p>

                <form action="" method="post" id="rejectionForm">
                    @csrf
                    <label for="observation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motifs
                        <span class="lg: text-xs italic">(facultatif)</span></label>
                    <textarea id="observation" rows="5" name="observation"
                        class="block p-2.5 w-full text-sm resize-none overflow-auto text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Veuillez écrire vos motifs ici..."></textarea>

                    <div class="flex justify-end gap-3 items-center mt-4">
                        <button type="submit" id="rejectBtn"
                            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-1.5 text-center transition ease-in duration-200 shadow-md">
                            <svg width="20" height="20" fill="currentColor" class="hidden mr-2 animate-spin"
                                viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M526 1394q0 53-37.5 90.5t-90.5 37.5q-52 0-90-38t-38-90q0-53 37.5-90.5t90.5-37.5 90.5 37.5 37.5 90.5zm498 206q0 53-37.5 90.5t-90.5 37.5-90.5-37.5-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm-704-704q0 53-37.5 90.5t-90.5 37.5-90.5-37.5-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm1202 498q0 52-38 90t-90 38q-53 0-90.5-37.5t-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm-964-996q0 66-47 113t-113 47-113-47-47-113 47-113 113-47 113 47 47 113zm1170 498q0 53-37.5 90.5t-90.5 37.5-90.5-37.5-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm-640-704q0 80-56 136t-136 56-136-56-56-136 56-136 136-56 136 56 56 136zm530 206q0 93-66 158.5t-158 65.5q-93 0-158.5-65.5t-65.5-158.5q0-92 65.5-158t158.5-66q92 0 158 66t66 158z">
                                </path>
                            </svg>
                            <span>Oui, Confirmer</span>
                        </button>
                        <button data-modal-hide="popup-modal" type="button"
                            class="py-1.5 px-5 ms-1 text-sm font-medium text-white focus:outline-none bg-gray-600 rounded-lg border border-gray-700 hover:bg-gray-700 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-800">Non,
                            Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function rejectRequest(req) {
        event.preventDefault();
        var observationValue = document.querySelector('#observation').value
        console.log(observationValue);

        document.querySelector("#rejectionForm").addEventListener('submit', function(event) {
            event.preventDefault()
            $("#rejectBtn svg").removeClass('hidden')
            $("#rejectBtn span").text('Chargement')
            $.ajax({
                url: `/${req.id}/validate`,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    demande: req,
                    status: 'rejete',
                    observation: observationValue
                },
                success: function(response) {
                    const smallModal = new Modal(document.getElementById(
                        'show-modal'))
                    smallModal.hide()
                    document.querySelector("body > div[modal-backdrop]")?.remove()
                    location.reload()
                },
                error: function(xhr, status, error) {
                    console.error('Erreur AJAX : ' + error);
                }
            })
        })
    }
</script>
