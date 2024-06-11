from django.urls import path
from . import views

app_name = 'coches'

urlpatterns = [
    path('', views.ListadoCochesView.as_view(), name='listado_coches'),
    path('coche/<slug:slug>/', views.DetalleCocheView.as_view(), name='detalle_coche'),
    path('crear-coche/', views.CrearCocheView.as_view(), name='crear_coche'),
]