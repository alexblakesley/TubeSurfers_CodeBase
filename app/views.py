
import numpy as np
import pandas as pd
import time
import datetime
import math
from core.objects.Timestamp import Timestamp
from django.http import HttpResponse
from django.template import loader


def index(request):
    TS = Timestamp()
    Data = TS.fetch(wheres="DBid = 1")

    template = loader.get_template('index.html')
    context = {
        'data': Data,
    }
    return HttpResponse(template.render(context, request))