<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function index(): View
    {
        $expenses = Expense::query()
            ->where('user_id', Auth::user()->id)
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
        $payload = $request->safe()->only(['name', 'value', 'payment_date']);

        $expense = new Expense([...$payload, 'user_id' => Auth::user()->id]);
        $expense->save();

        return redirect()->route('expenses.index')->with('success', "Expense {$payload['name']} has been created");
    }
}
