from django.contrib.auth.decorators import login_required
from django.contrib.messages import success
from django.core.paginator import Paginator
from django.db.models import Sum
from django.http import HttpRequest, HttpResponse
from django.shortcuts import get_object_or_404, redirect, render

from . import forms
from . import models


@login_required
def index(request: HttpRequest) -> HttpResponse:
    page_number = request.GET.get("page")

    expenses = models.Expense.objects.filter(user=request.user).order_by("-created_at")

    total_spent = expenses.aggregate(Sum("value"))["value__sum"] or 0
    count = expenses.count()
    average = round(total_spent / count, 2) if count > 0 else 0

    paginator = Paginator(expenses, 10)
    paginated_expenses = paginator.get_page(page_number)

    context = {
        "total_spent": total_spent,
        "average": average,
        "pagination": paginated_expenses,
    }

    return render(request, "expenses/index.html", context)


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

            success(request, f"Expense {name} has been created")

            return redirect("expenses:index")
    else:
        form = forms.CreateExpenseForm()

    return render(request, "expenses/create.html", {"form": form})


@login_required
def update(request: HttpRequest, id: int) -> HttpResponse:
    expense = get_object_or_404(models.Expense, pk=id, user=request.user)

    if request.method == "POST":
        form = forms.UpdateExpenseForm(request.POST)

        if form.is_valid():
            name = form.cleaned_data["name"]
            value = form.cleaned_data["value"]
            payment_date = form.cleaned_data["payment_date"]
            paid = form.cleaned_data["paid"]

            expense.name = name
            expense.value = value
            expense.payment_date = payment_date
            expense.paid = paid

            expense.save()

            success(request, f"Expense {expense.name} has been updated")

            return redirect("expenses:index")
    else:
        form = forms.UpdateExpenseForm(
            initial={
                "name": expense.name,
                "value": expense.value,
                "payment_date": expense.payment_date,
                "paid": expense.paid,
            }
        )

    return render(request, "expenses/update.html", {"expense": expense, "form": form})


@login_required
def delete(request: HttpRequest, id: int) -> HttpResponse:
    expense = get_object_or_404(models.Expense, pk=id, user=request.user)

    if request.method == "POST":
        expense.delete()

        success(request, f"Expense {expense.name} has been deleted")

        return redirect("expenses:index")

    return render(request, "expenses/delete.html", {"expense": expense})
