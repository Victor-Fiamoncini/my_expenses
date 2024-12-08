<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateInstallmentRequest;
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
        $installments = $expense->installments;
        dd($installments);
        return view('installment.index', compact('expense', 'installments'));
    }

    /**
     * Update an expense installment
     *
     * @param UpdateInstallmentRequest $request
     * @param Installment $installment
     * @return RedirectResponse
     */
    public function update(UpdateInstallmentRequest $request, Installment $installment): RedirectResponse
    {
        $paid = $request->safe()->input('paid');

        $installment->paid = $paid;
        $installment->save();

        return redirect()
            ->route('expenses.installments.index')
            ->with('success', "Installment has been updated");
    }
}
