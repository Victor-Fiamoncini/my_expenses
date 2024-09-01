from django.forms import CharField, DateField, DateInput, Form, ModelForm, TextInput

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
