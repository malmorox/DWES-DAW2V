from django.views import generic
from .models import Product
import calendar

class MonthListView(generic.ListView):
    template_name = 'produce/month_list.html'
    context_object_name = 'months'

    def get_queryset(self):
        return list(calendar.month_name)[1:]

class ProductListView(generic.ListView):
    model = Product
    template_name = 'produce/product_list.html'
    context_object_name = 'products'

    def get_queryset(self):
        month = self.kwargs['month']
        return Product.objects.filter(
            start_season__month__lte=month,
            end_season__month__gte=month,
        ) | Product.objects.filter(available_all_year=True)

class ProductDetailView(generic.DetailView):
    model = Product
    template_name = 'produce/product_detail.html'