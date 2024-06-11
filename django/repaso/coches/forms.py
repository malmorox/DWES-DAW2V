from django import forms
from .models import Coche

class CocheForm(forms.ModelForm):
    class Meta:
        model = Coche
        fields = ['fabricante', 'modelo', 'precio', 'nuevo_usado', 'combustible', 'foto']

class DatosUsuarioForm(forms.Form):
    sueldo_mensual = forms.DecimalField(label='Sueldo neto mensual', max_digits=10, decimal_places=2, min_value=0)
    gasto_alquiler = forms.DecimalField(label='Gasto en alquiler', max_digits=10, decimal_places=2, min_value=0)
    gastos_mensuales = forms.DecimalField(label='Otros gastos mensuales', max_digits=10, decimal_places=2, min_value=0)