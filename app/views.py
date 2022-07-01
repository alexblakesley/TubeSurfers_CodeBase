
from django.conf import settings
import numpy as np
import pandas as pd
import time
import datetime
import math
from core.objects.Data import Data
from core.objects.Timestamp import Timestamp
from django.http import HttpResponse
from django.template import loader


def index(request):
    template = loader.get_template('index.html')
    
    BaseURL = settings.BASE_URL

    context = {
        'BaseURL': BaseURL,
    }


    return HttpResponse(template.render(context, request))