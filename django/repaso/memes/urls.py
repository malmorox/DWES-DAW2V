from django.urls import path
from . import views

urlpatterns = [
    path('', views.MemeListView.as_view(), name='listado_memes'),
    path('meme/<int:meme_id>/', views.DetalleMemeView.as_view(), name='detalle_meme'),
]