from django import forms
from .models import Coche


class CocheForm(forms.ModelForm):
    class Meta:
        model = Coche
        fields = '__all__'
        widgets = {
            'fabricante': forms.Select(),
            'modelo': forms.TextInput(),
            'precio': forms.NumberInput(),
            'nuevo_usado': forms.Select(),
            'combustible': forms.Select(),
        }