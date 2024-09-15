from django.forms import (
    BooleanField,
    CharField,
    CheckboxInput,
    DateField,
    DateInput,
    Form,
    TextInput,
)


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
                "id": "expense-payment-date-input",
                "class": "form-control",
                "type": "date",
                "placeholder": "The payment date",
            },
        ),
    )


class UpdateExpenseForm(Form):
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
                "id": "expense-payment-date-input",
                "class": "form-control",
                "type": "date",
                "placeholder": "The payment date",
            },
        ),
    )

    paid = BooleanField(
        required=False,
        label="It is paid",
        label_suffix="",
        widget=CheckboxInput(attrs={"class": "form-check-input"}),
    )
