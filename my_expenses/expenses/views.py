from django.contrib.auth.decorators import login_required
from django.core.paginator import Paginator
from django.http import HttpRequest, HttpResponse
from django.shortcuts import redirect, render

from . import forms
from . import models


@login_required
def index(request: HttpRequest) -> HttpResponse:
    page_number = request.GET.get("page")

    expenses = request.user.expenses.all().order_by("-created_at")  # type: ignore

    paginator = Paginator(expenses, 10)
    pagination = paginator.get_page(page_number)

    return render(request, "expenses/index.html", {"pagination": pagination})


@login_required
def create(request: HttpRequest) -> HttpResponse:
    if request.method == "POST":
        form = forms.CreateExpenseForm(request.POST)

        if form.is_valid():
            name = form.cleaned_data["name"]
            value = form.cleaned_data["value"]
            payment_date = form.cleaned_data["payment_date"]

            expense = models.Expense()
            expense.name = name
            expense.value = value
            expense.payment_date = payment_date
            expense.user = request.user

            expense.save()

            return redirect("expenses:index")
    else:
        form = forms.CreateExpenseForm()

    return render(request, "expenses/create.html", {"form": form})


@login_required
def update(request: HttpRequest, id: int) -> HttpResponse:
    expense = models.Expense.objects.get(id=id)

    if request.method == "POST":
        form = forms.UpdateExpenseForm(request.POST, instance=expense)

        if form.is_valid():
            form.save()

            return redirect("expenses:index")
    else:
        form = forms.UpdateExpenseForm(instance=expense)

    return render(request, "expenses/update.html", {"expense": expense, "form": form})


@login_required
def delete(request: HttpRequest, id: int) -> HttpResponse:
    return render(request, "expenses/update.html")
