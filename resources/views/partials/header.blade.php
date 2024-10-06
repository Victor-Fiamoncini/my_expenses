<header class="position-relative py-4 bg-primary text-white">
    <div class="container d-flex justify-content-between align-items-center gap-4">
        <div class="d-flex justify-content-start align-items-center gap-4">
            <h1 class="fw-bold fs-2 text-white m-0 text-wrap">
                @yield('title', 'My Expenses')
            </h1>
        </div>

        <nav class="d-flex gap-2 flex-wrap justify-content-center align-items-center">
            <span class="text-white fw-bold fs-5 text-center">Any</span>

            <a href="{{ route('users.create') }}" class="text-white fw-bold fs-5">Sair</a>
        </nav>
    </div>
</header>
