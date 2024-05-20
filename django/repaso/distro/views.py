from rest_framework import viewsets
from .models import Distribucion
from .serializers import DistroSerializer


class DistroViewSet(viewsets.ModelViewSet):
    queryset = Distribucion.objects.all()
    serializer_class = DistroSerializer