@extends('layouts.auth')

@section('title', 'Connexion')

@section('content')
    <x-card title="Connexion">
        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                placeholder="Votre mot de passe"
                :required="true"
            />

            <x-checkbox-input
                label="Se souvenir de moi"
                name="remember"
                id="remember"
            />

            <div class="mt-3">
                <button type="submit" class="btn btn-primary w-100">
                    Se connecter
                </button>
            </div>

            <div class="mt-3 text-center text-secondary">
                Pas encore de compte ?
                <a href="{{ route('register') }}">Créer un compte</a>
            </div>
        </form>
    </x-card>
@endsection
