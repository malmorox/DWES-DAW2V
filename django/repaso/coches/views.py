# from django.shortcuts import render
from django.views import generic
from .models import Coche
from .forms import DatosUsuarioForm
import math


class ListadoCochesView(generic.ListView, generic.edit.FormMixin):
    model = Coche
    template_name = 'coches/listado_coches.html'
    context_object_name = 'coches'
    form_class = DatosUsuarioForm
    
    def get_queryset(self):
        return Coche.objects.all()
    
    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['form'] = self.get_form()
        context['resultados'] = getattr(self, 'resultados', None)
        return context
    
    def post(self, request, *args, **kwargs):
        form = self.get_form()
        if form.is_valid():
            sueldo_mensual = float(form.cleaned_data['sueldo_mensual'])
            gasto_alquiler = float(form.cleaned_data['gasto_alquiler'])
            gastos_mensuales = float(form.cleaned_data['gastos_mensuales'])
            ahorro_mensual = sueldo_mensual - (gasto_alquiler + gastos_mensuales)
            
            resultados = []
            coches = self.get_queryset()
            for coche in coches:
                if ahorro_mensual > 0:
                    meses_necesarios = math.ceil(float(coche.precio) / ahorro_mensual)
                    anos_ahorrar = meses_necesarios // 12
                    meses_ahorrar = meses_necesarios % 12
                    resultados.append({
                        'coche': coche,
                        'anos': anos_ahorrar,
                        'meses': meses_ahorrar
                    })
                    
            self.resultados = resultados
        else:
            self.resultados = None
            
        context = self.get_context_data()        
        return self.render_to_response(context)


class DetalleCocheView(generic.DetailView):
    model = Coche
    template_name = 'coches/detalle_coche.html'
    context_object_name = 'coche'