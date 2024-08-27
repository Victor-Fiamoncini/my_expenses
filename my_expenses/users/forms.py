from django.contrib.auth.forms import AuthenticationForm, UserCreationForm
from django.contrib.auth.models import User
from django.forms import (
    CharField,
    EmailField,
    EmailInput,
    TextInput,
    PasswordInput,
    ValidationError,
)


class SignInUserForm(AuthenticationForm):
    class Meta:
        model = User
        fields = ["email", "password"]

    email = EmailField(
        required=True,
        widget=EmailInput(
            attrs={"class": "form-control", "placeholder": "Enter your email"}
        ),
    )

    password = CharField(
        required=True,
        widget=PasswordInput(
            attrs={"class": "form-control", "placeholder": "Enter your password"}
        ),
    )


class SignUpUserForm(UserCreationForm):
    class Meta:
        model = User
        fields = ["username", "email", "password1", "password2"]

    username = CharField(
        label="Name",
        required=True,
        widget=TextInput(
            attrs={"class": "form-control", "placeholder": "Your name"},
        ),
    )

    email = EmailField(
        required=True,
        widget=EmailInput(
            attrs={"class": "form-control", "placeholder": "Your best email"}
        ),
    )

    password1 = CharField(
        label="Password",
        required=True,
        widget=PasswordInput(
            attrs={"class": "form-control", "placeholder": "A strong password"}
        ),
    )

    password2 = CharField(
        label="Password Confirmation",
        required=True,
        widget=PasswordInput(
            attrs={"class": "form-control", "placeholder": "Repeat password"}
        ),
    )

    def clean_email(self) -> str:
        email = str(self.cleaned_data.get("email"))

        if User.objects.filter(email=email).exists():
            raise ValidationError("A user with that email already exists.")

        return email
