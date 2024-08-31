from django.contrib.auth.decorators import login_required
from django.core.paginator import Paginator
from django.http import HttpRequest, HttpResponse
from django.shortcuts import render


@login_required
def index(request: HttpRequest) -> HttpResponse:
    user = request.user

    expenses = user.expenses.all().order_by("-created_at")

    paginator = Paginator(expenses, 10)
    page_number = request.GET.get("page")
    pagination = paginator.get_page(page_number)

    return render(request, "index.html", {"pagination": pagination})


@login_required
def create(request: HttpRequest) -> HttpResponse:
    user = request.user

    form = ""

    return render(request, "create.html", {"form": form})
