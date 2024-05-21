from django.views import generic
from rest_framework import viewsets
from .models import ObraDeArte
from .serializers import ObraDeArteSerializer


class ObraDeArteViewSet(viewsets.ModelViewSet):
    queryset = ObraDeArte.objects.all()
    serializer_class = ObraDeArteSerializer
    
    
class ListadoObrasDeA


