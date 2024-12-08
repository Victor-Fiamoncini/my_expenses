<form
    class="d-inline"
    action="{{ route("expenses.destroy", $expense) }}"
    method="POST"
>
    @csrf

    @method("DELETE")

    <button
        class="btn btn-small btn-danger text-white"
        type="submit"
        onclick="return confirm('Tem certeza de que deseja excluir esta despesa?')"
    >
        Apagar
    </button>
</form>
