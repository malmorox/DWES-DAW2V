# Generated by Django 5.0.1 on 2024-04-23 17:57

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('fallout', '0009_alter_personaje_foto_detalle_and_more'),
    ]

    operations = [
        migrations.AlterField(
            model_name='personaje',
            name='foto_detalle',
            field=models.ImageField(blank=True, null=True, upload_to='fallout/media/detalle_fotos'),
        ),
        migrations.AlterField(
            model_name='personaje',
            name='foto_portada',
            field=models.ImageField(blank=True, null=True, upload_to='fallout/media/portada_fotos'),
        ),
    ]
