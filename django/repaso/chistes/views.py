from django.views import generic
from .models import Chiste


class ChisteListView(generic.ListView):
    model = Chiste
    template_name = 'chistes/listado_chistes.html'
    context_object_name = 'chistes'