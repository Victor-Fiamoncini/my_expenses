from datetime import date, timedelta
from django.core.management.base import BaseCommand
from django.core.mail import EmailMessage
from django.template.loader import render_to_string

from ... import models


class Command(BaseCommand):
    help = "Email to notify users that their expenses payment day will be tomorrow"

    def handle(self, *args, **kwargs) -> None:
        tomorrow = date.today() + timedelta(days=1)

        users_with_expenses = (
            models.Expense.objects.filter(payment_date=tomorrow)
            .values_list("user__email", "user__username")
            .distinct()
        )

        for email, username in users_with_expenses:
            self._send_expense_report(email, username, tomorrow)

        self.stdout.write(
            self.style.SUCCESS("Expenses payment-date notifications sent successfully")
        )

    def _send_expense_report(
        self, email: str, username: str, payment_date: date
    ) -> None:
        expenses = models.Expense.objects.filter(
            user__email=email, payment_date=payment_date
        )

        html_message = render_to_string(
            "expenses/mail/payment_day_is_tomorrow_mail.html",
            {"expenses": expenses, "username": username},
        )

        email_message = EmailMessage(
            subject=f"The payment day of {username} is tomorrow",
            body=html_message,
            from_email="from@example.com",
            to=[email],
        )
        email_message.content_subtype = "html"
        email_message.send()

        self.stdout.write(
            self.style.SUCCESS(
                f"Successfully sent payment-date notification to {email}"
            )
        )
