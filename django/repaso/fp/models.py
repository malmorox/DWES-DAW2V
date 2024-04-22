from django.db import models


class FamiliaProfesional(models.Model):
    nombre = models.CharField(max_length=100)

    def __str__(self):
        return self.nombre


class Ciclo(models.Model):
    nombre = models.CharField(max_length=100)
    modulos = models.TextField()
    familia = models.ForeignKey(FamiliaProfesional, on_delete=models.CASCADE)

    def listado_modulos(self):
        return self.modulos.split("\n")

    def __str__(self):
        return self.nombre