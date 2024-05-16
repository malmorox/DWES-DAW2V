from django.shortcuts import render
from django.views import generic
from .models import Coche
from .forms import DatosUsuarioForm
import math


class ListadoCochesView(generic.ListView):
    template_name = 'coches/listado_coches.html'
    context_object_name = 'coches'
    
    def get_queryset(self):
        return Coche.objects.all()
    
    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['form'] = DatosUsuarioForm()
        context['resultados'] = None
        return context
    
    def post(self, request, *args, **kwargs):
        form = DatosUsuarioForm(request.POST)
        context = self.get_context_data()
        if form.is_valid():
            sueldo_mensual = form.cleaned_data['sueldo_mensual']
            gasto_alquiler = form.cleaned_data['gasto_alquiler']
            gastos_mensuales = form.cleaned_data['gastos_mensuales']
            ahorro_mensual = sueldo_mensual - gasto_alquiler - gastos_mensuales
            
            coches = self.get_queryset()
            resultados = {}
            for coche in coches:
                if ahorro_mensual > 0:
                    meses_necesarios = math.ceil(coche.precio / ahorro_mensual)
                    anos = meses_necesarios // 12
                    meses = meses_necesarios % 12
                    resultados[coche.pk] = {'anos': anos, 'meses': meses}
            context['resultados'] = resultados
        context['form'] = form
        return render(request, self.template_name, context)


class DetalleCocheView(generic.DetailView):
    model = Coche
    template_name = 'coches/detalle_coche.html'
    context_object_name = 'coche'