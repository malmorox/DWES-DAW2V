from django.shortcuts import render, get_object_or_404
from django.views import generic
from .models import FamiliaProfesional

class listado_familias(generic.ListView):
    familias = FamiliaProfesional.objects.all()
    return render(request, 'fp/listado_familias.html', {'familias': familias})

class detalle_ciclos(gee):
    familia = get_object_or_404(FamiliaProfesional, pk=familia_id)
    ciclos = familia.ciclo_set.all()
    return render(request, 'fp/detalle_ciclos.html', {'familia': familia, 'ciclos': ciclos})