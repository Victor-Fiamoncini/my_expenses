from django.contrib.auth.mixins import LoginRequiredMixin
from django.views.generic import TemplateView


class ExpensesListView(LoginRequiredMixin, TemplateView):
    template_name = "expenses_list.html"
