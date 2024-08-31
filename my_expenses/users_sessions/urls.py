from django.urls import path

from . import views

app_name = "users_sessions"

urlpatterns = [
    path("", views.create, name="create"),
    path("delete/", views.delete, name="delete"),
]
