@extends("layouts.app")

@section("title", " - Nova Despesa")

@section("content")
    <main id="expenses-create">
        @include("partials.errors")

        <form
            class="bg-light rounded border p-4"
            action="{{ route("expenses.store") }}"
            method="POST"
        >
            @csrf

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
                    value="{{ old("name") }}"
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
                    value="{{ old("value") }}"
                    placeholder="Um valor numérico"
                />
            </div>

            <div class="mb-4">
                <label
                    class="form-label"
                    for="payment-date"
                >
                    Data de pagamento:
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

            <div class="mb-5">
                <p>Essa despesa será paga de forma:</p>

                <div
                    class="btn-group"
                    role="group"
                    aria-label="Expense Type Group"
                >
                    <input
                        id="type-single"
                        class="btn-check"
                        name="type"
                        type="radio"
                        autocomplete="off"
                        value="SINGLE"
                        @if (old("type") === "SINGLE" || old("type") === null) checked @endif
                    />

                    <label
                        class="btn btn-sm btn-outline-primary"
                        for="type-single"
                    >
                        Avulsa
                    </label>

                    <input
                        id="type-monthly"
                        class="btn-check"
                        name="type"
                        type="radio"
                        autocomplete="off"
                        value="MONTHLY"
                        @if (old("type") === "MONTHLY") checked @endif
                    />

                    <label
                        class="btn btn-sm btn-outline-primary"
                        for="type-monthly"
                    >
                        Mensal
                    </label>
                </div>
            </div>

            <div class="d-flex justify-content-start align-items-center gap-2">
                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Cadastrar
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
