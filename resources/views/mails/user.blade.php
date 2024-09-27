@props(['user', 'manager'])
<x-guest-layout>
    Bonjour {{ $user['first_name'] }}.
    <br>
    Vous avez été choisi comme @if($manager) manager et @endif validateur dans Requisition App. Veuillez cliquez sur <a href="{{ route('home')}}">ce lien</a> pour créer une session.
</x-guest-layout>
