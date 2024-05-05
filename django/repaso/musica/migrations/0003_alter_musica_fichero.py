# Generated by Django 5.0.2 on 2024-05-04 16:24

import musica.models
from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('musica', '0002_alter_musica_fichero_alter_musica_nombre_and_more'),
    ]

    operations = [
        migrations.AlterField(
            model_name='musica',
            name='fichero',
            field=models.FileField(upload_to='archivos_mp3', validators=[musica.models.validar_mp3]),
        ),
    ]
