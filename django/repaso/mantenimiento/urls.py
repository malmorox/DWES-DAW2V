from django.urls import path, include
from rest_framework import routers
from . import views

router = routers.DefaultRouter()
router.register(r'mantenimientos', views.MantenimientoViewSet)

app_name = 'mantenimiento'
urlpatterns = [
    path('', views.ListadoMantenimientosView.as_view(), name='listado_mantenimientos'),
    path('<int:pk>/', views.DetalleMantenimientoView.as_view(), name='detalle_mantenimiento'),
    path('api/', include(router.urls)),
]
