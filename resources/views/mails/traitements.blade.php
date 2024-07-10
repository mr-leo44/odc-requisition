@props(['demande_id', 'num_demande', 'demandeur', 'level', 'validateur', 'is_validator', 'validated', 'observation', 'success'])
<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        @if ($success)
            @if ($is_validator)
                @if ($validated)
                    Bonjour {{ $validateur }}. La demande de requisition numero {{ $num_demande }} qui requerrait votre validation a été un succès.
                @else
                    Bonjour {{ $validateur }}, Vous avez une demande de requisition de la part de {{ $demandeur }}
                    enregistrée avec le numéro {{ $num_demande }}.
                    <div>
                        Veuillez cliquer
                        <a class="ms-3 text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-orange-600 dark:hover:bg-orange-700 focus:outline-none dark:focus:ring-orange-800"
                            href="{{ route('demandes.show', $demande_id) }}"> {{ __('ici') }}</a> pour valider.
                    </div>
                @endif
            @elseif ($validated && !$is_validator)
                    Bonjour {{ $demandeur }}, Votre demande de
                    requisition enregistrée par le numéro {{ $num_demande }} a été validée et est prête pour une livraison. 
                @else
                    Bonjour {{ $demandeur }}, Votre demande de
                    requisition enregistrée par le numéro {{ $num_demande }} a été validée et est passé au niveau
                    {{ $level }}.
            @endif
        @else
            @if ($is_validator)
                Bonjour {{ $validateur }}, La demande de requisition numéro {{ $num_demande }} a été rejetée avec
                succès.
            @else
                Bonjour {{ $demandeur }}, Votre demande de
                requisition enregistrée par le numéro {{ $num_demande }} a été rejetée.
                @if ($observation)
                    <br>
                    <p>
                        <span class="font-semibold">Motif :</span> {{ $observation }}.
                    </p>
                @endif
            @endif
        @endif
    </div>
</x-guest-layout>
