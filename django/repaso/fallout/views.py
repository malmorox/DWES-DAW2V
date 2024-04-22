from django.views import generic
from django.shortcuts import get_object_or_404
from .models import Personaje


class ListadoPersonajesView(generic.ListView):
    model = Personaje
    template_name = 'fallout/listado_personajes.html'
    context_object_name = 'personajes'
    
    def get_queryset(self):
        return Personaje.objects.all()


class DetallePersonajeView(generic.DetailView):
    model = Personaje
    template_name = 'fallout/detalle_personaje.html'
    context_object_name = 'personaje'
    
    def get_object(self):
        slug = self.kwargs.get('personaje_slug')
        return get_object_or_404(Personaje, slug=slug)