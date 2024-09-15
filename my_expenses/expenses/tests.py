from django.contrib.auth import get_user_model
from django.test import TestCase
from faker import Faker

from . import models


class ExpenseModelTestCase(TestCase):
    def setUp(self) -> None:
        self.faker = Faker()
        self.user = get_user_model().objects.create_user(
            username=self.faker.user_name(),
            email=self.faker.email(),
            password=self.faker.password(),
        )

    def test_must_create_an_expense_with_valid_data(self) -> None:
        name = self.faker.name()
        value = str(self.faker.pyfloat(left_digits=3, right_digits=2, positive=True))
        payment_date = self.faker.future_date()

        expense = models.Expense(
            name=name, value=value, payment_date=payment_date, user=self.user
        )
        expense.save()

        self.assertEqual(models.Expense.objects.get(name=name), expense)
