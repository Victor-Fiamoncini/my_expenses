from django.contrib.auth import authenticate, login, logout
from django.http import HttpRequest, HttpResponse
from django.shortcuts import redirect, render

from . import forms


def create(request: HttpRequest) -> HttpResponse:
    if request.user.is_authenticated:
        return redirect("expenses:index")

    if request.method == "POST":
        form = forms.CreateSessionForm(request.POST)

        if form.is_valid():
            email = form.cleaned_data["email"]
            password = form.cleaned_data["password"]

            user = authenticate(request, email=email, password=password)

            if user is not None:
                login(request, user)

                return redirect("expenses:index")
            else:
                form.add_error("email", "Invalid email or password.")
    else:
        form = forms.CreateSessionForm()

    return render(request, "users_sessions/create.html", {"form": form})


def delete(request: HttpRequest) -> HttpResponse:
    logout(request)

    return redirect("users_sessions:create")
