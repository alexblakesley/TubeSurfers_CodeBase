from core.objects.Data import Data
from django.http import JsonResponse

def index(request, fromStation, toStation, line, dataType, dataName):
    data = Data.FetchDataBetweenStations(fromStation, toStation, dataType, dataName)
    return JsonResponse(data, safe=False)
