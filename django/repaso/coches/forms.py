from django import forms


class DatosUsuarioForm(forms.Form):
    sueldo_mensual = forms.DecimalField(label='Sueldo neto mensual', max_digits=10, decimal_places=2, min_value=0)
    gasto_alquiler = forms.DecimalField(label='Gasto en alquiler', max_digits=10, decimal_places=2, min_value=0)
    gastos_mensuales = forms.DecimalField(label='Otros gastos mensuales', max_digits=10, decimal_places=2, min_value=0)