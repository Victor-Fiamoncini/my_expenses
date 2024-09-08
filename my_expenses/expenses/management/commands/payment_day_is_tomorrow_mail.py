from datetime import date, timedelta
from django.core.mail import EmailMessage
from django.template.loader import render_to_string
from django.utils import timezone
from logging import getLogger

from ... import models


logger = getLogger(__name__)


def handle(*args, **kwargs) -> None:
    tomorrow = timezone.now() + timedelta(days=1)

    users_with_expenses = (
        models.Expense.objects.filter(payment_date=tomorrow)
        .values_list("user__email", "user__username")
        .distinct()
    )

    for email, username in users_with_expenses:
        _send_expense_report(email, username, tomorrow)


def _send_expense_report(email: str, username: str, payment_date: date) -> None:
    expenses = models.Expense.objects.filter(
        user__email=email, user__username=username, payment_date=payment_date
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

    logger.info(f"Successfully sent payment-date notifications to: {username}/{email}")
