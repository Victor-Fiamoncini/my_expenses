from django.http import HttpRequest, HttpResponse
from django.shortcuts import render


def expenses_list(request: HttpRequest) -> HttpResponse:
    return render(request, "expenses_list.html")
