@php
    $formatter = new \NumberFormatter("pt_BR", \NumberFormatter::CURRENCY);
    $formattedValue = $formatter->formatCurrency($installment->value, "BRL");
@endphp

<form
    class="w-100 mb-2"
    action="{{ route("expenses.installments.update", compact("expense", "installment")) }}"
    method="POST"
>
    @csrf
    @method("PUT")

    @if ($installment->paid)
        <button
            class="w-100 btn btn-small btn-success text-white"
            type="button"
            disabled
        >
            Pago - <span>{{ $formattedValue }}</span>
        </button>
    @else
        <button
            class="w-100 btn btn-small btn-danger text-white"
            type="submit"
            onclick="return confirm('Deseja pagar esta despesa de {{ $formattedValue }}?')"
        >
            Pagar - <span>{{ $formattedValue }}</span>
        </button>
    @endif
</form>
