from django.contrib import messages
from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.models import User
from django.http import HttpRequest, HttpResponse
from django.shortcuts import redirect, render

from . import forms


def signin(request: HttpRequest) -> HttpResponse:

    return render(request, "signin.html")


def signup(request: HttpRequest) -> HttpResponse:
    if request.method == "POST":
        form = forms.SignUpUserForm(request.POST)

        if form.is_valid():
            form.save()

            username = form.cleaned_data["username"]
            messages.success(request, f"Welcome {username} to your expenses dashboard.")

            return redirect("expenses:expenses_list")
    else:
        form = forms.SignUpUserForm()

    return render(request, "signup.html", {"form": form})
