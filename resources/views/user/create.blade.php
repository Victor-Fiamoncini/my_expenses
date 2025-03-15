@extends("layouts.app")

@section("title", "Registrar")

@section("content")
    <main id="users-create">
        @include("partials.errors")

        <form class="bg-light rounded border p-4" action="{{ route("users.store") }}" method="POST">
            @csrf

            <div class="mb-2">
                <label class="form-label" for="name">
                    Nome:
                </label>

                <input
                    id="name"
                    class="form-control"
                    type="text"
                    name="name"
                    value="{{ old("name") }}"
                    placeholder="Seu nome"
                />
            </div>

            <div class="mb-2">
                <label class="form-label" for="email">
                    Email:
                </label>

                <input
                    id="email"
                    class="form-control"
                    type="email"
                    name="email"
                    value="{{ old("email") }}"
                    placeholder="Seu melhor email"
                />
            </div>

            <div class="mb-2">
                <label class="form-label" for="phone">
                    Telefone/Celular:
                </label>

                <input
                    id="phone"
                    class="form-control"
                    type="text"
                    name="phone"
                    value="{{ old("phone") }}"
                    placeholder="Seu melhor número para contato"
                />
            </div>

            <div class="mb-2">
                <label class="form-label" for="password">
                    Senha:
                </label>

                <input
                    id="password"
                    class="form-control"
                    type="password"
                    name="password"
                    placeholder="Uma senha forte"
                />
            </div>

            <div class="mb-4">
                <label class="form-label" for="password-confirmation">
                    Confirmação a senha:
                </label>

                <input
                    id="password-confirmation"
                    class="form-control"
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirme a senha"
                />
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-4 flex-wrap">
                <button type="submit" class="btn btn-success">
                    Registrar
                </button>

                <span>
                    Já se registrou?

                    <a href="{{ route("sessions.create") }}">Entre aqui</a>
                </span>
            </div>
        </form>
    </main>
@endsection
