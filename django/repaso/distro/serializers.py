from rest_framework import serializers
from .models import Distribucion

class DistroSerializer(serializers.ModelSerializer):
    class Meta:
        model = Distribucion
        fields = '__all__'