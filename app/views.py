
from django.conf import settings
from django.http import HttpResponse
from django.template import loader
from django.contrib.auth.decorators import login_required


def index(request):
    template = loader.get_template('index.html')
    
    BaseURL = settings.BASE_URL
    # IsDev = settings.IS_DEV
    IsDev = False

    context = {
        'BaseURL': BaseURL,
        'isDev': IsDev,
        'isSuperuser' : 'False'
    }


    return HttpResponse(template.render(context, request))

@login_required(login_url='/login/')
def extendedView(request):
    template = loader.get_template('index.html')
    
    BaseURL = settings.BASE_URL
    IsDev = True
    isSuperuser = request.user.is_superuser

    context = {
        'BaseURL': BaseURL,
        'isDev': IsDev,
        'isSuperuser': isSuperuser
    }


    return HttpResponse(template.render(context, request))