from django.db import models


class Producto(models.Model):
    nombre = models.CharField(max_length=80)
    foto_producto = models.ImageField(upload_to='frutas/media/productos_fotos', null=True, blank=True)
    descripcion = models.TextField()
    inicio_temporada = models.DateField()
    final_temporada = models.DateField()
    disponible_todo_ano = models.BooleanField(default=False)
    
    def __str__(self):  
        return self.nombre