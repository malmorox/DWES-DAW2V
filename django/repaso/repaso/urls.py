from django.contrib import admin
from django.urls import path, include
from django.conf import settings
from django.conf.urls.static import static

urlpatterns = [
    path('admin/', admin.site.urls),
    path('chistes/', include('chistes.urls')),
    path('fp/', include('fp.urls')),
    path('frutas', include('frutas.urls')),
    path('fallout/', include('fallout.urls')),
    path('musica/', include('musica.urls')),
    path('', include('memes.urls')),
    path('coches/', include('coches.urls')),
    path('api/v1/', include('distro.urls')),
]

if(settings.DEBUG):
    urlpatterns += static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)
