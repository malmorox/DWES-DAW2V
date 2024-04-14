from django.db import models


class FamiliaProfesional(models.Model):
    nombre = models.CharField(max_length=100)

    def __str__(self):
        return self.nombre


class Ciclo(models.Model):
    nombre = models.CharField(max_length=100)
    familia = models.ForeignKey(FamiliaProfesional, on_delete=models.CASCADE)

    def __str__(self):
        return self.nombre