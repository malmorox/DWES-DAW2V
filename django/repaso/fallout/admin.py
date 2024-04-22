from django.contrib import admin
from .models import Personaje


class PersonajeAdmin(admin.ModelAdmin):
    readonly_fields = ('slug',)

admin.site.register(Personaje, PersonajeAdmin) 