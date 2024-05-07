from django.views import generic
from .models import Coche


class ListadoCochesView(generic.ListView):
    model = Coche
    template_name = 'coches/listado_coches.html'
    context_object_name = 'coches'


class DetalleCocheView(generic.DetailView):
    model = Coche
    template_name = 'coches/detalle_coche.html'
    context_object_name = 'coche'

