@extends("layouts.app")

@section("title", " - Entrar")

@section("content")
    <main id="sessions-create">
        @include("partials.errors")

        <form
            class="bg-light rounded border p-4"
            action="{{ route("sessions.store") }}"
            method="POST"
        >
            @csrf

            <div class="mb-4">
                <label
                    class="form-label"
                    for="email"
                >
                    Email:
                </label>

                <input
                    id="email"
                    class="form-control"
                    type="email"
                    name="email"
                    value="{{ old("email") }}"
                    placeholder="Seu email"
                />
            </div>

            <div class="mb-5">
                <label
                    class="form-label"
                    for="password"
                >
                    Senha:
                </label>

                <input
                    id="password"
                    class="form-control"
                    type="password"
                    name="password"
                    placeholder="Sua senha"
                />
            </div>

            <div class="d-flex justify-content-between align-items-center gap-2">
                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Entrar
                </button>

                <span>
                    Ainda não se registrou?

                    <a href="{{ route("users.create") }}">Registre-se aqui</a>
                </span>
            </div>
        </form>
    </main>
@endsection
