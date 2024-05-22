from django.contrib import admin
from .models import Edificio, Tecnico, Mantenimiento


admin.site.register(Edificio)
admin.site.register(Tecnico)
admin.site.register(Mantenimiento)