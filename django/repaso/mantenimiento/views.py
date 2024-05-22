from django.views import generic
from rest_framework import viewsets
from .serializers import MantenimientoSerializer
from .models import Mantenimiento

class MantenimientoViewSet(viewsets.ModelViewSet):
    queryset = Mantenimiento.objects.all()
    serializer_class = MantenimientoSerializer


class ListadoMantenimientosView(generic.ListView):
    model = Mantenimiento
    context_object_name = 'mantenimientos'
    template_name = 'mantenimiento/listado_mantenimientos.html'
    paginate_by = 4
    
    # ESTO LO PONEMOS EN CASO DE PONER mantenimientos.has_previous POR EJEMPLO
    # def get_context_data(self, **kwargs):
    #     context = super().get_context_data(**kwargs)
    #     context['paginator'] = context['page_obj'].paginator
    #     return context


class DetalleMantenimientoView(generic.DetailView):
    model = Mantenimiento
    context_object_name = 'mantenimiento'
    template_name = 'mantenimiento/detalle_mantenimiento.html'