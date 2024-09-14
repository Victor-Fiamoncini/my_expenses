from datetime import date
from django import template

register = template.Library()


@register.filter(name="format_to_day_month_and_year")
def format_to_day_month_and_year(value: date | None) -> str:
    if type(value) is date:
        return value.strftime("%d/%m/%Y")

    raise Exception("Invalid value type provided")
