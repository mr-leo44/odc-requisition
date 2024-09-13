@props(['demande', 'is_validator'])
<x-guest-layout>
    <div class="w-full sm:max-w-md mx-auto mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        @if ($demande->success)
            @if ($is_validator)
                @if ($demande->validated)
                    Bonjour {{ $demande->validateur }}. La demande de requisition numéro {{ $demande->numero }} qui
                    requerrait votre validation a été un succès.
                @else
                    Bonjour {{ $demande->validateur }}, vous avez une demande de requisition de la part de
                    {{ $demande->user->name }}
                    enregistrée avec le numéro {{ $demande->numero }}.
                    <br>
                    <div>
                        Veuillez cliquer
                        <a class="ms-3 text-white bg-theme hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-theme dark:hover:bg-orange-700 focus:outline-none dark:focus:ring-orange-800"
                            href="{{ route('demandes.show', $demande->id) }}"> {{ __('ici') }}</a> pour valider.
                    </div>
                @endif
            @elseif ($demande->validated && !$is_validator)
                Bonjour {{ $demande->user->name }}, votre demande de
                requisition enregistrée par le numéro {{ $demande->numero }} a requis toutes les validation et est prête
                pour une
                livraison.
            @else
                @if ($demande->level > 0 && !$demande->validated)
                    Bonjour {{ $demande->user->name }}, votre demande de
                    requisition enregistrée par le numéro {{ $demande->numero }} a été validée et est passé au niveau
                    {{ $demande->level }}.
                @else
                    Bonjour {{ $demande->user->name }}, votre demande de
                    requisition a été enregistrée par le numéro {{ $demande->numero }} et mis en attente pour
                    validation.
                @endif
            @endif
        @else
            @if ($is_validator)
                Bonjour {{ $demande->validateur }}, la demande de requisition numéro {{ $demande->numero }} a été
                rejetée avec
                succès.
                <br><br>
                Motif : {{ $demande->observation  }}
            @else
                Bonjour {{ $demande->user->name }}, Votre demande de
                requisition enregistrée par le numéro {{ $demande->numero }} a été rejetée.
                @if ($demande->observation)
                    <br>
                    <p>
                        <span class="font-semibold">Motif :</span> {{ $demande->observation }}.
                    </p>
                @endif
            @endif
        @endif
    </div>
</x-guest-layout>
