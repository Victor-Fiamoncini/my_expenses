from django.urls import path

from . import views

app_name = "users"

urlpatterns = [
    path("", views.signin, name="signin"),
    path("signup/", views.signup, name="signup"),
    path("signout/", views.signout, name="signout"),
]