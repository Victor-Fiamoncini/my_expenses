<header class="position-relative bg-primary py-4 text-white">
    <div class="d-flex justify-content-between align-items-center container gap-4">
        <div class="d-flex justify-content-start align-items-center gap-4">
            <img
                id="header-logo"
                src="{{ asset("images/logo.png") }}"
                alt="My Expenses Logo"
            />

            <h1 class="fw-bold fs-2 text-wrap m-0 text-white">
                My Expenses @yield("title", "")
            </h1>
        </div>

        <nav class="d-flex justify-content-center align-items-center flex-wrap gap-2">
            @auth
                <span class="fw-bold fs-5 text-center text-white">
                    {{ Auth::user()->name }} &nbsp;|
                </span>

                <form
                    action="{{ route("sessions.destroy") }}"
                    method="POST"
                >
                    @csrf

                    @method("DELETE")

                    <button
                        type="submit"
                        class="fw-bold fs-5 border-0 bg-transparent text-white"
                    >
                        Sair
                    </button>
                </form>
            @endauth
        </nav>
    </div>
</header>
