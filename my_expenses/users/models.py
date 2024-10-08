from django.contrib.auth.models import AbstractUser
from django.db import models


class CustomUser(AbstractUser):
    email = models.EmailField(
        unique=True,
        error_messages={"unique": "A user with this email already exists."},
    )

    USERNAME_FIELD = "email"
    REQUIRED_FIELDS = ["username"]

    def save(self, *args, **kwargs) -> None:
        self.full_clean()

        super().save(*args, **kwargs)

    def __str__(self) -> str:
        return self.email
