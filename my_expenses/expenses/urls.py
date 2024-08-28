from django.urls import path

from . import views

app_name = "expenses"

urlpatterns = [
    path("", views.ExpensesListView.as_view(), name="expenses_list"),
]
