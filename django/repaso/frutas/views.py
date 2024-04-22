from django.views import generic
from .models import Producto
import calendar

class MonthListView(generic.ListView):
    template_name = 'frutas/lista_meses.html'
    context_object_name = 'meses'

    def get_queryset(self):
        return list(calendar.month_name)[1:]

class ProductMonthListView(generic.ListView):
    model = Producto
    template_name = 'frutas/product_list.html'
    context_object_name = 'productos'

    def get_queryset(self):
        month = self.kwargs['month']
        return Producto.objects.filter(
            start_season__month__lte=month,
            end_season__month__gte=month,
        ) | Producto.objects.filter(available_all_year=True)

class ProductDetailView(generic.DetailView):
    model = Producto
    template_name = 'frutas/product_detail.html'