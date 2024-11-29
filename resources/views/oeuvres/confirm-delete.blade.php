@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="alert alert-warning p-6 bg-yellow-100 rounded-lg shadow-lg w-full sm:w-96">
        <p>Cette œuvre est utilisée dans une vente. Voulez-vous envoyer une notification au commissaire-priseur ?</p>
        <form method="POST" action="{{ route('oeuvres.destroy', $oeuvre->id) }}">
            @csrf
            @method('DELETE')

            <!-- Champ caché pour confirmer l'envoi de l'email -->
            <input type="hidden" name="send_notification" value="yes">

            <button type="submit" class="btn btn-danger w-full mt-4">Oui, envoyer l'email et supprimer l'œuvre</button>
            <a href="{{ route('oeuvres.index') }}" class="btn btn-secondary w-full mt-2">Non, revenir à la liste des œuvres</a>
        </form>
    </div>
</div>
@endsection
