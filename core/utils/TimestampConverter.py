import datetime
import time


def ConvertDateTimeToTimestamp(DateTime):
    return time.mktime(datetime.datetime.strptime(DateTime, "%d/%m/%Y %H:%M:%S").timetuple())

def ConvertDateTimeToTimestampWithMs(DateTime):
    return time.mktime(datetime.datetime.strptime(DateTime, "%Y/%m/%d %H:%M:%S.%f").timetuple())