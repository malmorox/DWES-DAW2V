from django.views import generic
from .models import Producto
import calendar

class ListadoMesesView(generic.ListView):
    template_name = 'frutas/listado_meses.html'
    context_object_name = 'meses'

    def get_queryset(self):
        return list(calendar.month_name)[1:]

class ProductosPorMesView(generic.ListView):
    model = Producto
    template_name = 'frutas/product_list.html'
    context_object_name = 'productos'

    def get_queryset(self):
        mes = self.kwargs['mes']
        return Producto.objects.filter(inicio_temporada__month=mes) | \
                Producto.objects.filter(fin_temporada__month=mes) | \
                Producto.objects.filter(disponible_todo_anio=True)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['mes'] = self.get_mes_nombre()
        return context

    def get_mes_nombre(self):
        mes_numero = int(self.kwargs['mes'])
        return calendar.month_name[mes_numero]