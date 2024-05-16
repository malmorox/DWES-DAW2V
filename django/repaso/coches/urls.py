from django.urls import path
from . import views

urlpatterns = [
    path('', views.ListadoCochesView.as_view(), name='listado_coches'),
    path('coche/<int:pk>/', views.DetalleCocheView.as_view(), name='detalle_coche'),
]