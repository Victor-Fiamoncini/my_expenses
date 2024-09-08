import locale

from django import template

register = template.Library()

locale.setlocale(locale.LC_ALL, "pt_BR.UTF-8")


@register.filter(name="format_to_currency")
def format_to_currency(value: float) -> str:
    return locale.currency(value, grouping=True)
