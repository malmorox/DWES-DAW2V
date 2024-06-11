from django.db import models
from django.utils.text import slugify


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
    slug = models.SlugField(max_length=50, unique=True, null=True, blank=True)
    
    def save(self, *args, **kwargs):
        if not self.slug:
            self.slug = slugify(f"{self.fabricante}-{self.modelo}")
        super().save(*args, **kwargs)    

    def __str__(self):
        return f"{self.fabricante} {self.modelo}"