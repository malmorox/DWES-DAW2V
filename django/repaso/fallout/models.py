from django.db import models
from django.utils.text import slugify


class Personaje(models.Model):
    nombre = models.CharField(max_length=30)
    descripcion = models.TextField()
    foto_portada = models.ImageField(upload_to='fallout/media/portada_fotos', null=True, blank=True)
    foto_detalle = models.ImageField(upload_to='fallout/media/detalle_fotos', null=True, blank=True)
    slug = models.SlugField(unique=True)
    
    def save(self, *args, **kwargs):
        if not self.slug:
            self.slug = slugify(self.nombre)
        super().save(*args, **kwargs)

    def __str__(self):  
        return self.nombre 
