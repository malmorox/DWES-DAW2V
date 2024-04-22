#from django.shortcuts import get_object_or_404
from django.views import generic
from .models import Personaje


class ListadoPersonajesView(generic.ListView):
    model = Personaje
    template_name = 'fallout/listado_familias.html'
    context_object_name = 'familias'
    
    def get_queryset(self):
        return Personaje.objects.all()


class DetallePersonajeView(generic.DetailView):
    model = Personaje
    template_name = 'fallout/detalle_ciclos.html'
    context_object_name = 'familia'

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        familia = self.get_object()
        context['ciclos'] = familia.ciclo_set.all()
        return context