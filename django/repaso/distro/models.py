from django.db import models


class Distribucion(models.Model):
    nombre = models.CharField(max_length=100)
    version = models.CharField(max_length=100)
    basada = models.CharField(max_length=100)
    activa = models.BooleanField(default=True)

    def __str__(self):
        return self.nombre
