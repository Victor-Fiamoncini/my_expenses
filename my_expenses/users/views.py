from django.contrib.auth import authenticate, login
from django.contrib.messages import success
from django.http import HttpRequest, HttpResponse
from django.shortcuts import redirect, render

from . import forms


def create(request: HttpRequest) -> HttpResponse:
    if request.method == "POST":
        form = forms.CreateUserForm(request.POST)

        if form.is_valid():
            form.save()

            username = form.cleaned_data["username"]
            email = form.cleaned_data["email"]
            password = form.cleaned_data["password1"]

            user = authenticate(request, email=email, password=password)

            if user is not None:
                login(request, user)

                success(request, f"Welcome {username} to your dashboard.")

                return redirect("expenses:index")
    else:
        form = forms.CreateUserForm()

    return render(request, "users/create.html", {"form": form})
