from django.contrib import admin
from .models import Meme

# class MemeAdmin(admin.ModelAdmin):
#     fieldsets = [
#         (None, {"fields": ["meme", "nombre", "descripcion"]}),
#         ("Información fecha", {"fields": ["fecha"]}),
#     ]

admin.site.register(Meme)
