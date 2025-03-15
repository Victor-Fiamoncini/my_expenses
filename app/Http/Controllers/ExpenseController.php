<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\Installment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    /**
     * Renders expense.index view with paginated user expenses
     *
     * @return View
     */
    public function index(): View
    {
        $expenses = Expense::query()
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('expense.index', compact('expenses'));
    }

    /**
     * Renders expense.create view
     *
     * @return View
     */
    public function create(): View
    {
        return view('expense.create');
    }

    /**
     * Stores a new expense
     *
     * @param StoreExpenseRequest $request
     * @return RedirectResponse
     */
    public function store(StoreExpenseRequest $request): RedirectResponse
    {
        $payload = $request->safe()->only([
            'name',
            'value',
            'payment_date',
            'number_of_installments',
        ]);

        $type = $payload['number_of_installments'] > 1 ?
            Expense::IN_INSTALLMENTS :
            Expense::SINGLE;

        $expense = Expense::create([
            ...$payload,
            'type' => $type,
            'user_id' => Auth::id(),
        ]);

        if ($type === Expense::IN_INSTALLMENTS) {
            $installmentValue = $payload['value'] / $payload['number_of_installments'];

            for ($i = 0; $i < $payload['number_of_installments']; $i++) {
                Installment::create([
                    'paid' => false,
                    'value' => $installmentValue,
                    'expense_id' => $expense->id,
                ]);
            }
        }

        return redirect()
            ->route('expenses.index')
            ->with('success', "Expense {$payload['name']} has been created");
    }

    /**
     * Renders expense.edit view
     *
     * @param Expense $expense
     * @return View
     */
    public function edit(Expense $expense): View
    {
        Gate::authorize('view', $expense);

        return view('expense.edit', compact('expense'));
    }

    /**
     * Update an expense
     *
     * @param UpdateExpenseRequest $request
     * @param Expense $expense
     * @return RedirectResponse
     */
    public function update(UpdateExpenseRequest $request, Expense $expense): RedirectResponse
    {
        Gate::authorize('update', $expense);

        $payload = $request->safe()->only(['name', 'value', 'payment_date', 'paid']);

        $expense->update($payload);

        return redirect()
            ->route('expenses.index')
            ->with('success', "Expense {$payload['name']} has been updated");
    }

    /**
     * Deletes an expense
     *
     * @param Expense $expense
     * @return RedirectResponse
     */
    public function destroy(Expense $expense): RedirectResponse
    {
        Gate::authorize('delete', $expense);

        $expense->delete();

        return redirect()
            ->route('expenses.index')
            ->with('success', "Expense $expense->name has been deleted");
    }
}
