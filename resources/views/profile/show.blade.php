@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
    <div class="ds-header">
        <div class="container-xl">
            <h1 class="ds-header-title">Mon profil</h1>
            <p class="ds-header-subtitle">Informations du compte</p>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-6">
                    <x-card title="Informations personnelles">
                        <div class="mb-3">
                            <label class="form-label text-secondary">Nom</label>
                            <p class="mb-0">{{ $user->name }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary">Adresse email</label>
                            <p class="mb-0">{{ $user->email }}</p>
                        </div>
                        <div>
                            <label class="form-label text-secondary">Membre depuis</label>
                            <p class="mb-0">{{ $user->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                    </x-card>
                </div>
            </div>
        </div>
    </div>
@endsection
