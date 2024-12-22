<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Installment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InstallmentController extends Controller
{
    /**
     * Renders installment.index view
     *
     * @return View
     */
    public function index(Expense $expense): View
    {
        $installments = $expense->installments()->orderBy('id')->get();

        return view('installment.index', compact('expense', 'installments'));
    }

    /**
     * Update an expense installment
     *
     * @param Expense $expense
     * @param Installment $installment
     * @return RedirectResponse
     */
    public function update(Expense $expense, Installment $installment): RedirectResponse
    {
        $installment->paid = true;
        $installment->save();

        $allPaid = $expense->installments->every(fn ($installment) => $installment->is_paid);

        if (!$allPaid) {
            $expense->paid = true;
            $expense->save();
        }

        return redirect()
            ->route('expenses.installments.index', compact('expense'))
            ->with('success', "Installment has been paid");
    }
}
