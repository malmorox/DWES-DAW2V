from django.db import models


class Chiste(models.Model):
    titulo = models.CharField(max_length=100)
    texto = models.TextField()
    adultos_si_no = models.BooleanField(default=False)
    fecha_creacion = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return self.titulo
