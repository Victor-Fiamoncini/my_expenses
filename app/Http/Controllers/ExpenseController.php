<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function index(): View
    {
        $expenses = Expense::where('user_id', Auth::user()->id)->paginate(10);

        return view('expense.index', compact('expenses'));
    }
}
