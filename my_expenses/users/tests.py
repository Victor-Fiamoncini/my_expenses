from django.core.exceptions import ValidationError
from django.test import TestCase
from faker import Faker

from . import models


class CustomUserModelTestCase(TestCase):
    def setUp(self) -> None:
        self.faker = Faker()
        self.userEmail = self.faker.email()
        self.userName = self.faker.user_name()

    def test_must_create_an_user_with_valid_data(self) -> None:
        user = models.CustomUser.objects.create_user(
            username=self.faker.user_name(),
            email=self.userEmail,
            password=self.faker.password(),
        )

        self.assertEqual(models.CustomUser.objects.get(email=self.userEmail), user)

    def test_must_raise_validation_error_when_trying_to_create_user_with_existing_email(
        self,
    ) -> None:
        models.CustomUser.objects.create_user(
            username=self.faker.user_name(),
            email=self.userEmail,
            password=self.faker.password(),
        )

        with self.assertRaises(ValidationError):
            models.CustomUser.objects.create_user(
                username=self.faker.user_name(),
                email=self.userEmail,
                password=self.faker.password(),
            )

    def test_must_raise_validation_error_when_trying_to_create_user_with_existing_username(
        self,
    ) -> None:
        models.CustomUser.objects.create_user(
            username=self.userName,
            email=self.faker.email(),
            password=self.faker.password(),
        )

        with self.assertRaises(ValidationError):
            models.CustomUser.objects.create_user(
                username=self.userName,
                email=self.faker.email(),
                password=self.faker.password(),
            )
