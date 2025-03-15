<header class="bg-primary text-white">
    <div class="container d-flex justify-content-between align-items-center gap-4 flex-column flex-lg-row p-4">
        <div class="d-flex justify-content-center justify-content-sm-start align-items-center gap-4 flex-wrap flex-sm-nowrap">
            <img
                id="header-logo"
                src="{{ asset("images/logo.png") }}"
                alt="My Expenses Logo"
                title="My Expenses"
            />

            <h1 class="fw-bold fs-2 text-wrap text-center m-0 text-white">
                @auth
                    @yield("title", "My Expenses")
                @else
                    My Expenses - @yield("title", "")
                @endauth
            </h1>
        </div>

        @auth
            <nav class="d-flex justify-content-center align-items-center flex-wrap gap-2">
                <span class="fw-bold fs-5 text-center text-white">
                    {{ Auth::user()->name }} &nbsp;|
                </span>

                <form
                    action="{{ route("sessions.destroy") }}"
                    method="POST"
                >
                    @csrf

                    @method("DELETE")

                    <button type="submit" class="fw-bold fs-5 border-0 bg-transparent text-white">
                        Sair
                    </button>
                </form>
            </nav>
        @endauth
    </div>
</header>
