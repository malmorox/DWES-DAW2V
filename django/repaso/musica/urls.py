from django.urls import path
from . import views

app_name = 'musica'

urlpatterns = [
    path('', views.ListadoMesesView.as_view(), name='listado_meses'),
    path('listado/', views.ListadoMusicaListView.as_view(), name='listado_musica'),
]