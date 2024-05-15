from django import forms
from .models import Comentario

class ComentarioForm(forms.ModelForm):
    class Meta:
        model = Comentario
        fields = ['nombre','contenido']
        labels = {
            'nombre': 'Nombre',
            'contenido': 'Comentario'
        }
        widgets = {
            'nombre': forms.TextInput(attrs={'class':'form-control'}),
            'contenido': forms.Textarea(attrs={'class':'form-control'})
        }