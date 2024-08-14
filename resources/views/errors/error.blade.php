<x-app-layout>
    <div
        class="flex-col items-center justify-center rounded shadow border border-gray-200 dark:border-gray-700 bg-white py-14 px-5 shadow-default dark:bg-gray-800 sm:py-20">
        <div class="min-h-[85vh] flex flex-col sm:justify-center items-center sm:pt-0 dark:bg-slate-800 bg-gray-100">
            <div>
                <img src="{{ asset('img/error_illustration.svg') }}" class="mx-auto w-80" alt="illustration">
            </div>
            <div class="mt-5 text-center">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    @if ($status_code === 403)
                        Désolé, vous n'êtes pas autorisé à accéder à cette page
                    @elseif ($status_code === 404)
                        Désolé, cette page est introuvable
                    @elseif ($status_code === 419)
                        Page expirée
                    @elseif ($status_code === 500)
                        Une erreur inattendue s'est produite sur le serveur
                    @elseif ($status_code === 503)
                        Serveur indisponible
                    @else
                    @endif
                </h2>

                <button
                    class="mt-7 inline-flex items-center gap-2 rounded-md bg-primary px-6 py-3 font-medium bg-orange-400 text-white hover:bg-opacity-90"
                    onclick="history.back()">
                    <svg class="fill-current" width="16" height="14" viewBox="0 0 16 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.7492 6.38125H2.73984L7.52109 1.51562C7.77422 1.2625 7.77422 0.86875 7.52109 0.615625C7.26797 0.3625 6.87422 0.3625 6.62109 0.615625L0.799219 6.52187C0.546094 6.775 0.546094 7.16875 0.799219 7.42188L6.62109 13.3281C6.73359 13.4406 6.90234 13.525 7.07109 13.525C7.23984 13.525 7.38047 13.4687 7.52109 13.3562C7.77422 13.1031 7.77422 12.7094 7.52109 12.4563L2.76797 7.64687H14.7492C15.0867 7.64687 15.368 7.36562 15.368 7.02812C15.368 6.6625 15.0867 6.38125 14.7492 6.38125Z"
                            fill=""></path>
                    </svg>
                    <span>Retourner en arrière</span>
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
