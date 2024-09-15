from django.contrib.auth import get_user_model
from django.core.management.base import BaseCommand
from faker import Faker

from ... import models


class Command(BaseCommand):
    help = "Seed the database with dummy user and expenses data"

    def handle(self, *args, **kwargs) -> None:
        faker = Faker()

        user = get_user_model().objects.create_user(
            username=faker.user_name(),
            email="usermail@mail.com",
            password="password123",
        )

        for _ in range(10):
            name = faker.name()
            value = str(faker.pyfloat(left_digits=3, right_digits=2, positive=True))
            payment_date = faker.past_date()

            models.Expense.objects.create(
                name=name, value=value, payment_date=payment_date, user=user
            )

        self.stdout.write(
            self.style.SUCCESS("User and expenses seeding completed successfully")
        )
