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

            <div class="row">
                <div class="col mb-4">
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

                <div class="col mb-4">
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
            </div>

            <div class="row">
                <div class="col mb-5">
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
                        value="{{ old("payment_date") }}"
                        placeholder="Quando irá pagar/quitar"
                    />
                </div>

                <div class="col mb-5">
                    <label
                        class="form-label"
                        for="number-of-installments"
                    >
                        Número de Parcelas:
                    </label>

                    <select
                        id="number-of-installments"
                        class="form-select"
                        name="number_of_installments"
                        aria-label="Number of installments select"
                    >
                        <option value="1">1x (Avulsa)</option>
                        <option value="2">2x</option>
                        <option value="3">3x</option>
                        <option value="4">4x</option>
                        <option value="5">5x</option>
                        <option value="6">6x</option>
                        <option value="7">7x</option>
                        <option value="8">8x</option>
                        <option value="9">9x</option>
                        <option value="10">10x</option>
                        <option value="11">11x</option>
                        <option value="12">12x</option>
                    </select>
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
