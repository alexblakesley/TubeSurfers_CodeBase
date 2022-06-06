
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
    
    context = {
        'temp': None,
    }

    return HttpResponse(template.render(context, request))