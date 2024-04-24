from django.urls import path
from . import views

app_name = 'frutas'

urlpatterns = [
    path('', views.ListadoMesesView.as_view(), name='listado_meses'),
    path('<int:mes>/', views.ProductosPorMesView.as_view(), name='productos_por_mes'),
]