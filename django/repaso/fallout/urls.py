from django.urls import path
from . import views

urlpatterns = [
    path('', views.ListadoPersonajesView.as_view(), name='listado_familias'),
    path('familia/<int:pk>/', views.DetalleCiclosView.as_view(), name='detalle_ciclos'),
]