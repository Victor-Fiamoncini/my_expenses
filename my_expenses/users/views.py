from django.contrib import messages
from django.contrib.auth import authenticate, login, logout
from django.http import HttpRequest, HttpResponse
from django.shortcuts import redirect, render

from . import forms


def signin(request: HttpRequest) -> HttpResponse:
    if request.method == "POST":
        form = forms.SignInUserForm(request.POST)

        if form.is_valid():
            email = form.cleaned_data["email"]
            password = form.cleaned_data["password"]

            user = authenticate(request, email=email, password=password)

            if user is not None:
                login(request, user)

                return redirect("expenses:expenses_list")
            else:
                form.add_error("email", "Invalid email or password.")
    else:
        form = forms.SignInUserForm()

    return render(request, "signin.html", {"form": form})


def signup(request: HttpRequest) -> HttpResponse:
    if request.method == "POST":
        form = forms.SignUpUserForm(request.POST)

        if form.is_valid():
            form.save()

            username = form.cleaned_data["username"]
            email = form.cleaned_data["email"]
            password = form.cleaned_data["password1"]

            user = authenticate(request, email=email, password=password)

            if user is not None:
                login(request, user)

                messages.success(request, f"Welcome {username} to your dashboard.")

                return redirect("expenses:expenses_list")
    else:
        form = forms.SignUpUserForm()

    return render(request, "signup.html", {"form": form})
