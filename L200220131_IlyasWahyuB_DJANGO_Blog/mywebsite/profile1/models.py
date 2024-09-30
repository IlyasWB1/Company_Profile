from django.db import models

# Create your models here
class Profile(models.Model):
    name = models.CharField(max_length=100)
    email = models.EmailField()
    phone = models.CharField(max_length=15)
    address = models.TextField()
    about = models.TextField()
    education = models.TextField()
    experience = models.TextField()
    skills = models.TextField()