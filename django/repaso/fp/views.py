#from django.shortcuts import get_object_or_404
from django.views import generic
from .models import FamiliaProfesional


class ListadoFamiliasView(generic.ListView):
    model = FamiliaProfesional
    template_name = 'fp/listado_familias.html'
    context_object_name = 'familias'
    
    def get_queryset(self):
        return FamiliaProfesional.objects.all()


class DetalleCiclosView(generic.DetailView):
    model = FamiliaProfesional
    template_name = 'fp/detalle_ciclos.html'
    context_object_name = 'familia'

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        familia = self.get_object()
        context['ciclos'] = familia.object.ciclo_set.all()
        return context