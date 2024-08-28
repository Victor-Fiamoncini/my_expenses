from django.contrib.auth import authenticate, login, logout
from django.contrib import messages
from django.http import HttpRequest, HttpResponse
from django.shortcuts import redirect
from django.urls import reverse_lazy
from django.views.generic import FormView, View

from . import forms


class SignInView(FormView):
    template_name = "signin.html"
    form_class = forms.SignInUserForm
    success_url = reverse_lazy("expenses:expenses_list")

    def form_valid(self, form: forms.SignInUserForm) -> HttpResponse:
        email = form.cleaned_data["email"]
        password = form.cleaned_data["password"]

        user = authenticate(self.request, email=email, password=password)

        if user is not None:
            login(self.request, user)

            return super().form_valid(form)

        form.add_error("email", "Invalid email or password.")

        return self.form_invalid(form)


class SignUpView(FormView):
    template_name = "signup.html"
    form_class = forms.SignUpUserForm
    success_url = reverse_lazy("expenses:expenses_list")

    def form_valid(self, form: forms.SignUpUserForm) -> HttpResponse:
        form.save()

        username = form.cleaned_data["username"]
        email = form.cleaned_data["email"]
        password = form.cleaned_data["password1"]

        user = authenticate(self.request, email=email, password=password)

        if user is not None:
            login(self.request, user)

            messages.success(self.request, f"Welcome {username} to your dashboard.")

            return super().form_valid(form)

        return self.form_invalid(form)


class SignOutView(View):
    def get(self, request: HttpRequest, *args, **kwargs) -> HttpResponse:
        logout(request)

        return redirect("users:signin")
