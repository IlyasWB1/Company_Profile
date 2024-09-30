from django.shortcuts import render

# Create your views here.
def index(request):
    # Logic for your index view
    return render(request, 'profile1/index.html') 

def about(request):
    return render(request, 'profile1/about.html') 

def projects(request):
    return render(request, 'projects/post.html')

def contact(request):
    return render(request, 'contact/contact.html')