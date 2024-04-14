from django.shortcuts import render
from .models import Chiste


def listado_chistes(request):
    chistes = Chiste.objects.all()
    return render(request, 'chistes/listado_chistes.html', {'chistes': chistes})
