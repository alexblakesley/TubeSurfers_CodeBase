
from django.conf import settings
from django.http import HttpResponse
from django.template import loader


def index(request):
    template = loader.get_template('index.html')
    
    BaseURL = settings.BASE_URL
    IsDev = settings.IS_DEV

    context = {
        'BaseURL': BaseURL,
        'isDev': IsDev
    }


    return HttpResponse(template.render(context, request))