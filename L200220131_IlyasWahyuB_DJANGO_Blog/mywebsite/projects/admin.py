from django.contrib import admin
from django.urls import path, include
# Register your models here.


urlpatterns = [
    path('admin/', admin.site.urls),
    path('', include('profile1.urls')),
    path('projects/', include('projects.urls')),
    path('contact/', include('contact.urls')),
]