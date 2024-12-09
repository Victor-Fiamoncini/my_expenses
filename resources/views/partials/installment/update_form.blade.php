<form
    class="d-inline justify-self-end"
    action="{{ route("expenses.installments.update", compact("expense", "installment")) }}"
    method="POST"
>
    @csrf
    @method("PUT")

    <button
        class="btn btn-small btn-success text-white"
        type="submit"
        onclick="return confirm('Tem certeza de que deseja pagar esta despesa?')"
    >
        Pagar
    </button>
</form>
