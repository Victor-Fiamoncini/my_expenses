from django.conf import settings
from django.core.exceptions import ValidationError
from django.db.models import (
    CASCADE,
    CharField,
    DateField,
    DateTimeField,
    DecimalField,
    ForeignKey,
    Model,
    TextChoices,
)
from django.utils import timezone


class Category(TextChoices):
    BILL = "BILL", "Bill"
    FOOD = "FOOD", "Food"
    RENT = "RENT", "Rent"
    SUBSCRIPTION = "SUBSCRIPTION", "Subscription"
    TRANSPORTATION = "TRANSPORTATION", "Transportation"
    UTILITIES = "UTILITIES", "Utilities"


class Expense(Model):
    name = CharField(max_length=150)
    category = CharField(max_length=50, choices=Category.choices, default=Category.BILL)
    value = DecimalField(max_digits=10, decimal_places=2)
    payment_date = DateField()
    user = ForeignKey(
        settings.AUTH_USER_MODEL, on_delete=CASCADE, related_name="expenses"
    )
    created_at = DateTimeField(auto_now_add=True)
    updated_at = DateTimeField(auto_now=True)

    def clean(self) -> None:
        if self.payment_date and self.payment_date < timezone.now().date():
            raise ValidationError(
                {"payment_date": "The payment date can't be in the past"}
            )

    def __str__(self):
        return self.name
