from django.urls import path
from . import views

urlpatterns = [
    path('', views.listado_familias, name='listado_familias'),
    path('<int:familia_id>/', views.detalle_ciclos, name='detalle_ciclos'),
]