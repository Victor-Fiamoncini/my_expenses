<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\ExpenseBilling;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function index(): View
    {
        $expenses = Expense::query()
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('expense.index', compact('expenses'));
    }

    public function create(): View
    {
        return view('expense.create');
    }

    public function store(StoreExpenseRequest $request): RedirectResponse
    {
        $payload = $request->safe()->only(['name', 'value', 'payment_date', 'type']);

        $expense = new Expense([...$payload, 'user_id' => Auth::id()]);
        $expense->save();

        if ($payload['type'] === Expense::SINGLE) {
            $billing = new ExpenseBilling(['value' => $payload['value'], 'expense_id' => $expense->id]);
            $billing->save();
        } else {
            dd('TODO create billing installments');
        }

        return redirect()
            ->route('expenses.index')
            ->with('success', "Expense {$payload['name']} has been created");
    }

    public function edit(Expense $expense): View
    {
        Gate::authorize('view', $expense);

        return view('expense.edit', compact('expense'));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense): RedirectResponse
    {
        Gate::authorize('update', $expense);

        $payload = $request->safe()->only(['name', 'value', 'payment_date', 'paid']);

        $expense->update($payload);

        return redirect()->route('expenses.index')->with('success', "Expense {$payload['name']} has been updated");
    }

    public function destroy(Expense $expense): RedirectResponse
    {
        Gate::authorize('delete', $expense);

        $expense->delete();

        return redirect()->route('expenses.index')->with('success', "Expense $expense->name has been deleted");
    }
}
