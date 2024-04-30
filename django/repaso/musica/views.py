from django.views import generic
from .models import Musica


class ListadoMusicaListView(generic.ListView):
    model = Musica
    template_name = 'musica/listado_paginado.html'
    paginate_by = 3