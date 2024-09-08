from datetime import date
from django.forms import (
    CharField,
    DateField,
    DateInput,
    Form,
    ModelForm,
    TextInput,
    ValidationError,
)
from django.utils import timezone

from . import models


class CreateExpenseForm(Form):
    name = CharField(
        widget=TextInput(
            attrs={
                "class": "form-control",
                "placeholder": "A name that makes sense with the expense",
            },
        ),
    )

    value = CharField(
        widget=TextInput(
            attrs={
                "id": "expense-value-input",
                "class": "form-control",
                "placeholder": "A numeric value",
            },
        ),
    )

    payment_date = DateField(
        input_formats=["%d/%m/%Y"],
        widget=DateInput(
            format="%d/%m/%Y",
            attrs={
                "class": "form-control",
                "type": "date",
                "placeholder": "The payment date",
            },
        ),
    )


class UpdateExpenseForm(ModelForm):
    class Meta:
        model = models.Expense
        fields = ["name", "value", "payment_date"]

    name = CharField(
        widget=TextInput(
            attrs={
                "class": "form-control",
                "placeholder": "A name that makes sense with the expense",
            },
        ),
    )

    value = CharField(
        widget=TextInput(
            attrs={
                "id": "expense-value-input",
                "class": "form-control",
                "placeholder": "A numeric value",
            },
        ),
    )

    payment_date = DateField(
        input_formats=["%d/%m/%Y"],
        widget=DateInput(
            format="%d/%m/%Y",
            attrs={
                "class": "form-control",
                "type": "date",
                "placeholder": "The payment date",
            },
        ),
    )

    def clean_payment_date(self) -> date:
        payment_date = self.cleaned_data.get("payment_date")

        if payment_date and payment_date < timezone.now().date():
            raise ValidationError(
                "The payment date cannot be in the past (yesterday or older)."
            )

        return payment_date  # type: ignore
