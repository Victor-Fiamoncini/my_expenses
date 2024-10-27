@extends('layouts.app')

@section('title', ' - Nova Despesa')

@section('content')
    <main id="expenses-create">
        @include('partials.errors')

        <form class="bg-light p-4 border rounded" action="{{ route('expenses.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="form-label" for="name">Nome:</label>

                <input
                    class="form-control"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Um nova que tenha relação com a despesa"
                />
            </div>

            <div class="mb-4">
                <label class="form-label" for="value">Valor:</label>

                <input
                    id="expense-value-input"
                    class="form-control"
                    type="text"
                    name="value"
                    value="{{ old('value') }}"
                    placeholder="Um valor numérico"
                />
            </div>

            <div class="mb-5">
                <label class="form-label" for="payment_date">Data de Pagamento:</label>

                <input
                    id="expense-payment-date-input"
                    class="form-control"
                    type="text"
                    name="payment_date"
                    value="{{ old('payment_date') }}"
                    placeholder="A em que irá pagar/quitar"
                />
            </div>

            <div class="d-flex justify-content-start align-items-center gap-2">
                <button type="submit" class="btn btn-primary">Cadastrar</button>

                <a href="{{ route('expenses.index') }}" class="btn btn-secondary text-white">Voltar</a>
            </div>
        </form>
    </main>
@endsection
