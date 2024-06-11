from django.urls import path
from . import views

urlpatterns = [
    path('', views.ListadoMemesView.as_view(), name='listado_memes'),
    path('meme/<int:pk>/', views.DetalleMemeView.as_view(), name='detalle_meme'),
]