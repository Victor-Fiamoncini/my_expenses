from datetime import date
from django import template
from django.utils import timezone

register = template.Library()


@register.filter(name="is_a_past_date")
def is_a_past_date(value: date) -> bool:
    return value < timezone.now().date()


@register.filter(name="format_to_day_month_and_year")
def format_to_day_month_and_year(value: date) -> str:
    return value.strftime("%d/%m/%Y")
