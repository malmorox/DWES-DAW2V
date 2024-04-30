from django.views import generic
from .models import Musica


class MusicaListView(generic.ListView):
    model = Musica
    template_name = 'musica/feed.html'
    paginate_by = 3