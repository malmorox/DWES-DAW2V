from django.shortcuts import render
from django.views import generic
from .models import Chiste


class ChisteListView(generic.ListView):
    model = Chiste
    template_name = 'chistes/listado_chistes.html'
