from django.urls import path
from . import views

urlpatterns = [
    path('', views.ListadoPersonajesView.as_view(), name='listado_personajes'),
    path('personaje/<slug:personaje_slug>/', views.DetallePersonajeView.as_view(), name='detalle_personaje'),
]