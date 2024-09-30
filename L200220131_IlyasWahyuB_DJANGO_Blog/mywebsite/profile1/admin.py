from django.contrib import admin
from django.urls import path, include
from .models import Profile
# Register your models here.

admin.site.register(Profile)
urlpatterns = [
    path('admin/', admin.site.urls),
    path('', include('profile1.urls')),
    path('projects/', include('projects.urls')),
    path('contact/', include('contact.urls')),
]