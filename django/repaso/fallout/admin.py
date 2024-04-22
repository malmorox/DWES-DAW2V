from django.contrib import admin
from .models import Personaje


class PersonajeAdmin(admin.ModelAdmin):
    prepopulated_fields = {'slug': ('nombre',)}
    readonly_fields = ('slug',)

admin.site.register(Personaje, PersonajeAdmin) 