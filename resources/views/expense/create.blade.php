@extends("layouts.app")

@section("title", "Nova Despesa")

@section("content")
    <main id="expenses-create">
        @include("partials.errors")

        <form
            class="bg-light rounded border p-4"
            action="{{ route("expenses.store") }}"
            method="POST"
        >
            @csrf

            <div class="row mb-2 g-2">
                <div class="col-12 col-md-6">
                    <label class="form-label" for="name">
                        Nome:
                    </label>

                    <input
                        id="name"
                        class="form-control"
                        type="text"
                        name="name"
                        value="{{ old("name") }}"
                        placeholder="Um nova que tenha relação com a despesa"
                    />
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label" for="value">
                        Valor:
                    </label>

                    <input
                        id="value"
                        class="form-control"
                        type="text"
                        name="value"
                        value="{{ old("value") }}"
                        placeholder="Um valor numérico"
                    />
                </div>
            </div>

            <div class="row g-2 mb-4">
                <div class="col-12 col-md-6">
                    <label class="form-label" for="payment-date">
                        Data de Pagamento:
                    </label>

                    <input
                        id="payment-date"
                        class="form-control"
                        type="text"
                        name="payment_date"
                        value="{{ old("payment_date") }}"
                        placeholder="Quando irá pagar/quitar"
                    />
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label" for="number-of-installments">
                        Número de Parcelas:
                    </label>

                    <select
                        id="number-of-installments"
                        class="form-select"
                        name="number_of_installments"
                        aria-label="Number of installments select"
                    >
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $i }}x {{ $i === 1 ? '(Avulsa)' : '' }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-start align-items-center gap-2">
                <button type="submit" class="btn btn-success">
                    Cadastrar
                </button>

                <a href="{{ route("expenses.index") }}" class="btn btn-secondary text-white">
                    Voltar
                </a>
            </div>
        </form>
    </main>
@endsection
