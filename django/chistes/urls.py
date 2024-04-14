from django.urls import path
from . import views

urlpatterns = [
    path('', views.listado_chistes, name='listado_chistes'),
]
