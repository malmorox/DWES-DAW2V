from django.db import models

class Meme(models.Model):
    imagen = models.ImageField(upload_to='memes/')
    descripcion = models.TextField()

class Comentario(models.Model):
    meme = models.ForeignKey(Meme, related_name='comentarios', on_delete=models.CASCADE)
    nombre = models.CharField(max_length=100)
    contenido = models.TextField()
    fecha = models.DateTimeField(auto_now_add=True)