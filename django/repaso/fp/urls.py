from django.urls import path
from . import views

urlpatterns = [
    path('', views.ListadoFamiliasView.as_view(), name='listado_familias'),
    path('familia/<int:pk>/', views.DetalleCiclosView.as_view(), name='detalle_ciclos'),
]