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
)
from django.utils import timezone


class Expense(Model):
    name = CharField(max_length=150)
    value = DecimalField(max_digits=10, decimal_places=2)
    payment_date = DateField()
    user = ForeignKey(
        settings.AUTH_USER_MODEL, on_delete=CASCADE, related_name="expenses"
    )
    created_at = DateTimeField(auto_now_add=True)
    updated_at = DateTimeField(auto_now=True)

    def clean(self, *args, **kwargs) -> None:
        if self.payment_date < timezone.now().date():
            raise ValidationError(
                {"payment_date": "The payment date can't be in the past."}
            )

        super().clean(*args, **kwargs)

    def save(self, *args, **kwargs) -> None:
        self.full_clean()

        super().save(*args, **kwargs)

    def __str__(self) -> str:
        return self.name
