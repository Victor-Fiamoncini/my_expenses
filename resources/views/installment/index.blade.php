@php
    $formatter = new \NumberFormatter("pt_BR", \NumberFormatter::CURRENCY);
@endphp

@extends("layouts.app")

@section("title", " - Parcelas de $expense->name")

@section("content")
    <main id="installments-index">
        @include("partials.messages")

        <div class="d-flex justify-content-between align-items-center mb-4 gap-4">
            <a
                href="{{ route("expenses.index") }}"
                class="btn btn-small btn-secondary text-white"
            >
                Voltar
            </a>
        </div>

        <ul class="list-group">
            @foreach ($installments as $index => $installment)
                <a
                    href="#"
                    class="list-group-item d-flex align-items-center"
                >
                    <div>
                        <span class="fw-bold">{{ $index + 1 }}x</span>

                        <span>{{ $installment->value }}</span>
                    </div>

                    @if (!$installment->paid)
                        @include("partials.installment.update_form", compact("expense", "installment"))
                    @endif
                </a>
            @endforeach
        </ul>
    </main>
@endsection
