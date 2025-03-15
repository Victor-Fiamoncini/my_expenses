@extends("layouts.app")

@section("title", "Parcelas de $expense->name")

@section("content")
    <main id="installments-index">
        @include("partials.messages")

        <section class="bg-light w-50 m-auto rounded border p-4">
            <ul class="w-100 d-flex flex-column mb-3 p-0">
                @foreach ($installments as $installment)
                    @include("partials.installment.update_form", compact("expense", "installment"))
                @endforeach
            </ul>

            <div class="d-flex justify-content-start align-items-center">
                <a
                    href="{{ route("expenses.index") }}"
                    class="btn btn-secondary text-white"
                >
                    Voltar
                </a>
            </div>
        </section>
    </main>
@endsection
