<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function index(): View
    {
        return view('expense.index');
    }
}
