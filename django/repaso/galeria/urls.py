from django.urls import path, include
from rest_framework import routers
from .views import ObraDeArteViewSet


router = routers.DefaultRouter()
router.register(r'obras', ObraDeArteViewSet)

app_name = 'galeria'
urlpatterns = [
    path('api/v1/', include(router.urls)),
]
