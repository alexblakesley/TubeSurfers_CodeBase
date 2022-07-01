from django.http import HttpResponse
from django.template import loader
import json

def load(request):
    json_content = open('/core/Consts.json')
    # json_content = json.load(f)
    return HttpResponse(
        json_content,
        content_type='application/json',
        status=200
    )