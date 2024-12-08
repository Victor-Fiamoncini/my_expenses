<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateExpenseInstallmentRequest;
use App\Models\Expense;
use App\Models\ExpenseInstallment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExpenseInstallmentController extends Controller
{
    /**
     * Renders expense_installment.index view
     *
     * @return View
     */
    public function index(Expense $expense): View
    {
        $expenseInstallments = ExpenseInstallment::query()
            ->where('expense_id', $expense->id)
            ->where('user_id', Auth::id());

        return view('expense_installment.index', compact('expenseInstallments'));
    }

    /**
     * Update an expense installment
     *
     * @param UpdateExpenseInstallmentRequest $request
     * @param ExpenseInstallment $expenseInstallment
     * @return RedirectResponse
     */
    public function update(
        UpdateExpenseInstallmentRequest $request,
        ExpenseInstallment $expenseInstallment
    ): RedirectResponse {
        $payload = $request->safe()->only(['paid']);

        $expenseInstallment->update($payload);

        return redirect()
            ->route('expense-installments.index')
            ->with('success', "Expense installment has been updated");
    }
}
