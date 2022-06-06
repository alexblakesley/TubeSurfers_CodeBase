import datetime
import time


def ConvertDateTimeToTimestamp(DateTime):
    return time.mktime(datetime.datetime.strptime(DateTime, "%d/%m/%Y %H:%M:%S").timetuple())