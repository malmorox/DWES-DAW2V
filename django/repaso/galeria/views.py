from django.views import generic
from rest_framework import viewsets
from .models import ObraDeArte
from .serializers import ObraDeArteSerializer


class ObraDeArteViewSet(viewsets.ModelViewSet):
    queryset = ObraDeArte.objects.all()
    serializer_class = ObraDeArteSerializer
    
    
class ListadoObrasDeArteView(generic.ListView):
    model = ObraDeArte
    context_object_name = 'obras'
    template_name = 'galeria/listado_obras.html'
    

class DetalleObraDeArteView(generic.DetailView):
    model = ObraDeArte
    context_object_name = 'obra'
    template_name = 'galeria/detalle_obra.html'


