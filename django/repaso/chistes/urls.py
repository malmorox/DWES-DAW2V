from django.urls import path
from . import views

app_name = 'chistes'

urlpatterns = [
    path('', views.ChisteListView.as_view(), name='listado_chistes'),
]