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


def FormularioDatosUsuario(request):
    if request.method == 'POST':
        form = DatosUsuarioForm(request.POST)
        if form.is_valid():
            sueldo_mensual = form.cleaned_data['sueldo_mensual']
            gasto_alquiler = form.cleaned_data['gasto_alquiler']
            gastos_mensuales = form.cleaned_data['gastos_mensuales']
            gasto_total = sueldo_mensual - gasto_alquiler - gastos_mensuales
            return render(request, 'coches/resultado.html', {'gasto_total': gasto_total})
    else:
        form = DatosUsuarioForm()
    return render(request, 'coches/formulario_datos_usuario.html', {'form': form})