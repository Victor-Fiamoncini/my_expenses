@extends("layouts.app")

@section("title", " - Editar $expense->name")

@section("content")
    <main id="expenses-update">
        @include("partials.errors")

        <form
            class="bg-light rounded border p-4"
            action="{{ route("expenses.update", $expense) }}"
            method="POST"
        >
            @csrf
            @method("PUT")

            <div class="mb-4">
                <label
                    class="form-label"
                    for="name"
                >
                    Nome:
                </label>

                <input
                    id="name"
                    class="form-control"
                    type="text"
                    name="name"
                    value="{{ old("name", $expense->name) }}"
                    placeholder="Um nova que tenha relação com a despesa"
                />
            </div>

            <div class="mb-4">
                <label
                    class="form-label"
                    for="value"
                >
                    Valor:
                </label>

                <input
                    id="value"
                    class="form-control"
                    type="text"
                    name="value"
                    value="{{ old("value", $expense->value) }}"
                    placeholder="Um valor numérico"
                />
            </div>

            <div class="mb-4">
                <label
                    class="form-label"
                    for="payment-date"
                >
                    Data de Pagamento:
                </label>

                <input
                    id="payment-date"
                    class="form-control"
                    type="text"
                    name="payment_date"
                    value="{{ old("payment_date", $expense->payment_date) }}"
                    placeholder="A em que irá pagar/quitar"
                />
            </div>

            <div class="form-check mb-5">
                <input
                    type="hidden"
                    name="paid"
                    value="0"
                />

                <input
                    id="paid"
                    class="form-check-input"
                    type="checkbox"
                    name="paid"
                    value="1"
                    {{ old("paid", $expense->paid) ? "checked" : "" }}
                />

                <label
                    class="form-label"
                    for="paid"
                >
                    Está Pago
                </label>
            </div>

            <div class="d-flex justify-content-start align-items-center gap-2">
                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Atualizar
                </button>

                <a
                    href="{{ route("expenses.index") }}"
                    class="btn btn-secondary text-white"
                >
                    Voltar
                </a>
            </div>
        </form>
    </main>
@endsection
