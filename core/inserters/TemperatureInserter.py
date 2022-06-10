
import pandas as pd
from core.objects.Timestamp import Timestamp
from core.objects.temperature.DP import DP
from core.objects.temperature.WET import WET
from core.objects.temperature.WBGT import WBGT
from core.objects.temperature.TA import TA
from core.objects.temperature.TG import TG
from core.objects.temperature.Humidity import Humidity
from core.utils.TimestampConverter import ConvertDateTimeToTimestamp


def Insert(csvName, tubeName):

    return;
    data = pd.read_csv("data/temperature/"+tubeName+"_"+ csvName +".csv")

    data = data.reset_index()  # make sure indexes pair with number of rows

    InsertDataToDB = False #Only set to true once file has been run, the TimeStamps DataFrame looks correct and no errors are thrown

    TemperatureData = pd.DataFrame()
    TemperatureData['Timestamp'] = data['Date'] + ' ' + data['Time']
    TemperatureData['WBGT'] = data['Value']
    TemperatureData['Humidity'] = data['Value.1']
    TemperatureData['TA'] = data['Value.2']
    TemperatureData['TG'] = data['Value.3']
    TemperatureData['WET'] = data['Value.4']
    TemperatureData['DP'] = data['Value.5']

    for index, row in TemperatureData.iterrows():
        TSData = Timestamp.GetClosest(ConvertDateTimeToTimestamp(row['Timestamp']))
        if (TSData == None):
            continue;

        TSid = TSData[0]

        dp = DP(TSid, row['DP'])
        if InsertDataToDB:
            dp.insert()

        wet = WET(TSid, row['WET'])
        if InsertDataToDB:
            wet.insert()

        ta = TA(TSid, row['TA'])
        if InsertDataToDB:
            ta.insert()

        tg = TG(TSid, row['TG'])
        if InsertDataToDB:
            tg.insert()

        wbgt = WBGT(TSid, row['WBGT'])
        if InsertDataToDB:
            wbgt.insert()

        humidity = Humidity(TSid, row['Humidity'])
        if InsertDataToDB:
            humidity.insert()