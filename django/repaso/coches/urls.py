from django.urls import path
from . import views

urlpatterns = [
    path('', views.ListadoCochesView.as_view(), name='listado_coches'),
    path('coche/<int:coche_id>/', views.DetalleCocheView.as_view(), name='detalle_coche'),
]