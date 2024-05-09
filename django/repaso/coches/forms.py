from django import forms
from .models import Coche


class DatosUsuarioForm(forms.ModelForm):
    sueldo_mensual = forms.DecimalField(label='Sueldo neto mensual')
    gasto_alquiler = forms.DecimalField(label='Gasto en alquiler')
    gastos_mensuales = forms.DecimalField(label='Otros gastos mensuales')