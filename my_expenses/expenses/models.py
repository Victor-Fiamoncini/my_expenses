from django.conf import settings
from django.db.models import (
    BooleanField,
    CASCADE,
    CharField,
    DateField,
    DateTimeField,
    DecimalField,
    ForeignKey,
    Model,
)

auth = settings.AUTH_USER_MODEL


class Expense(Model):
    name = CharField(max_length=150)
    value = DecimalField(max_digits=10, decimal_places=2)
    payment_date = DateField()
    paid = BooleanField(default=False)
    user = ForeignKey(auth, on_delete=CASCADE, related_name="expenses")
    created_at = DateTimeField(auto_now_add=True)
    updated_at = DateTimeField(auto_now=True)

    def __str__(self) -> str:
        return self.name
