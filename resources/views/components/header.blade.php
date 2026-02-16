<header class="navbar navbar-expand-md" style="background: var(--ds-bg-secondary); border-bottom: 1px solid var(--ds-bg-tertiary);">
    <div class="container-xl">
        <a href="/" class="navbar-brand" style="color: var(--ds-text-primary); font-weight: var(--ds-font-bold);">
            {{ config('app.name', 'Laravel') }}
        </a>

        <div class="navbar-nav ms-auto flex-row gap-2 align-items-center">
            @auth
                <a href="{{ route('profile.show') }}" class="text-secondary text-decoration-none" style="font-size: var(--ds-text-sm);">
                    {{ Auth::user()->name }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-ghost-secondary btn-sm">
                        Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost-secondary btn-sm">
                    Connexion
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                    Inscription
                </a>
            @endauth
        </div>
    </div>
</header>
