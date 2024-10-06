@extends('layouts.app')

@section('title', 'My Expenses - Registrar')

@section('content')

    <main id="users-create">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            @include('partials.errors')

            <div class="mb-4">
                <label class="form-label" for="email">Email:</label>

                <input
                    class="form-control"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Seu melhor email"
                />
            </div>

            <div class="mb-4">
                <label class="form-label" for="name">Nome:</label>

                <input
                    class="form-control"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Seu nome"
                />
            </div>

            <div class="mb-4">
                <label class="form-label" for="password">Senha:</label>

                <input class="form-control" type="password" name="password" placeholder="Uma senha forte" />
            </div>

            <div class="mb-4">
                <label class="form-label" for="password_confirmation">Confirme a senha:</label>

                <input
                    class="form-control"
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirme a senha"
                />
            </div>

            <div class="d-flex justify-content-between align-items-center gap-4">
                <button type="submit" class="btn btn-primary">Registrar</button>

                <span>
                    Já se registrou?
                    <a href="{{ route('users.create') }}">Entre aqui</a>
                </span>
            </div>
        </form>
    </main>
@endsection