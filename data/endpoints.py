from core.objects.Data import Data
from django.http import JsonResponse

def index(request, fromStation, toStation, line, dataType, dataName):
    if (dataType == "Timestamp") :
        data = Data.FetchTimestamps(fromStation, toStation, line)
    else: 
        data = Data.FetchDataBetweenStations(fromStation, toStation, line, dataType, dataName)
    return JsonResponse(data, safe=False)
