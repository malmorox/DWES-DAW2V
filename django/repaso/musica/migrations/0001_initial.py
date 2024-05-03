# Generated by Django 5.0.2 on 2024-05-02 15:00

from django.db import migrations, models


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Musica',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('nombre', models.CharField(max_length=2, unique=True)),
                ('tipo_musica', models.CharField(choices=[('rock', 'ROCK'), ('pop', 'POP'), ('jazz', 'JAZZ'), ('electronica', 'ELECTRÓNICA'), ('clasica', 'CLÁSICA')], max_length=20)),
                ('fichero', models.FileField(upload_to='musica/media/archivos_mp3')),
            ],
        ),
    ]