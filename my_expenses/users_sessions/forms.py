from django.forms import CharField, EmailField, EmailInput, Form, PasswordInput


class CreateSessionForm(Form):
    email = EmailField(
        label="Email",
        widget=EmailInput(
            attrs={"class": "form-control", "placeholder": "Enter your email"}
        ),
    )

    password = CharField(
        widget=PasswordInput(
            attrs={"class": "form-control", "placeholder": "Enter your password"}
        ),
    )
