@props(['user', 'manager'])
<x-guest-layout>
    Bonjour {{ $user['first_name'] }}.
    <br>
    vous avez été choisi comme @if($manager) manager et @endif validateur dans Orange Requisition. Veuillez cliquez sur <a href="{{ route('home')}}">ce lien</a> pour créer une session.
</x-guest-layout>
