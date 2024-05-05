from django.db import models
from django.core.exceptions import ValidationError
import os

def validar_mp3(value):
    extension = os.path.splitext(value.name)[1] 
    if extension.lower() != '.mp3':
        raise ValidationError('El archivo debe ser un MP3')

class Musica(models.Model):
    nombre = models.CharField(max_length=50,unique=True)
    TIPOS_MUSICA = [
        ('Rock', 'ROCK'),
        ('Pop', 'POP'),
        ('Jazz', 'JAZZ'),
        ('Electrónica', 'ELECTRÓNICA'),
        ('Clasica', 'CLÁSICA'),
    ]
    tipo_musica = models.CharField(max_length=20, choices=TIPOS_MUSICA)
    fichero = models.FileField(upload_to='archivos_mp3', validators=[validar_mp3])

    def __str__(self):
        return self.nombre