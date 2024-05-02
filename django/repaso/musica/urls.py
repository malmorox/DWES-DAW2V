from django.urls import path
from . import views

app_name = 'musica'

urlpatterns = [
    path('', views.ListadoMusicaListView.as_view(), name='listado_musica'),
]