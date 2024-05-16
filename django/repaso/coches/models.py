from django.db import models


class Coche(models.Model):
    fabricante = models.CharField(max_length=50)
    modelo = models.CharField(max_length=50)
    precio = models.FloatField()
    NUEVO_USADO = [
        ('Nuevo', 'NUEVO'),
        ('Usado', 'USADO'),
    ]
    nuevo_usado = models.CharField(max_length=5, choices=NUEVO_USADO)
    TIPOS_COMBUSTIBLE = [
        ('Gasolina', 'GASOLINA'),
        ('Diesel', 'DIESEL'),
    ]
    combustible = models.CharField(max_length=8, choices=TIPOS_COMBUSTIBLE)
    foto = models.ImageField(upload_to='coches/media/fotos_coches', null=True, blank=True)

    def __str__(self):
        return f"{self.fabricante} {self.modelo}"