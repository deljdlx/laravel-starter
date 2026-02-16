@extends('layouts.auth')

@section('title', 'Inscription')

@section('content')
    <x-card title="Inscription">
        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <x-text-input
                label="Nom"
                name="name"
                id="name"
                :value="old('name')"
                placeholder="Votre nom"
                :required="true"
            />

            <x-text-input
                label="Adresse email"
                name="email"
                id="email"
                type="email"
                :value="old('email')"
                placeholder="nom@exemple.com"
                :required="true"
            />

            <x-text-input
                label="Mot de passe"
                name="password"
                id="password"
                type="password"
                placeholder="Minimum 8 caractères"
                :required="true"
            />

            <x-text-input
                label="Confirmer le mot de passe"
                name="password_confirmation"
                id="password_confirmation"
                type="password"
                placeholder="Confirmez votre mot de passe"
                :required="true"
            />

            <div class="mt-3">
                <button type="submit" class="btn btn-primary w-100">
                    Créer mon compte
                </button>
            </div>

            <div class="mt-3 text-center text-secondary">
                Déjà un compte ?
                <a href="{{ route('login') }}">Se connecter</a>
            </div>
        </form>
    </x-card>
@endsection
