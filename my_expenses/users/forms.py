from django.contrib.auth.forms import UserCreationForm
from django.forms import CharField, EmailField, EmailInput, TextInput, PasswordInput

from . import models


class CreateUserForm(UserCreationForm):
    class Meta:
        model = models.CustomUser
        fields = ["username", "email", "password1", "password2"]

    username = CharField(
        label="Name",
        widget=TextInput(
            attrs={"class": "form-control", "placeholder": "Your name"},
        ),
    )

    email = EmailField(
        widget=EmailInput(
            attrs={"class": "form-control", "placeholder": "Your best email"}
        ),
    )

    password1 = CharField(
        label="Password",
        widget=PasswordInput(
            attrs={"class": "form-control", "placeholder": "A strong password"}
        ),
    )

    password2 = CharField(
        label="Password Confirmation",
        widget=PasswordInput(
            attrs={"class": "form-control", "placeholder": "Repeat password"}
        ),
    )
