from django.shortcuts import render, get_object_or_404
from .models import FamiliaProfesional

def listado_familias(request):
    familias = FamiliaProfesional.objects.all()
    return render(request, 'fp/listado_familias.html', {'familias': familias})

def detalle_ciclos(request, familia_id):
    familia = get_object_or_404(FamiliaProfesional, pk=familia_id)
    ciclos = familia.ciclo_set.all()
    return render(request, 'fp/detalle_ciclos.html', {'familia': familia, 'ciclos': ciclos})