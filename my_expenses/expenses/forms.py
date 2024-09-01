from django.forms import CharField, DateField, DateInput, Form, TextInput


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
