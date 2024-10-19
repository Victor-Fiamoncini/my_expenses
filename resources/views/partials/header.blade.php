<header class="position-relative py-4 bg-primary text-white">
    <div class="container d-flex justify-content-between align-items-center gap-4">
        <div class="d-flex justify-content-start align-items-center gap-4">
            <img id="header-logo" src="{{ asset('images/logo.png') }}" alt="My Expenses Logo" />

            <h1 class="fw-bold fs-2 text-white m-0 text-wrap">
                My Expenses @yield('title', '')
            </h1>
        </div>

        <nav class="d-flex gap-2 flex-wrap justify-content-center align-items-center">
            @if (Auth::check())
                <span class="text-white fw-bold fs-5 text-center">
                    {{ Auth::user()->name }}
                </span>

                <form action="{{ route('sessions.destroy') }}" method="POST">
                    @csrf

                    @method('DELETE')

                    <button type="submit" class="text-white fw-bold fs-5 bg-transparent border-0">
                        Sair
                    </button>
                </form>
            @endif
        </nav>
    </div>
</header>
