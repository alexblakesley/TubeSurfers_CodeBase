
import pandas as pd
from core.objects.Timestamp import Timestamp
from core.objects.pollution.CO2 import CO2
from core.objects.pollution.Humidity import Humidity
from core.objects.pollution.Pressure import Pressure
from core.objects.pollution.PM25 import PM25
from core.objects.pollution.HealthIndex import HealthIndex
from core.objects.pollution.Temperature import Temperature
from core.utils.TimestampConverter import ConvertDateTimeToTimestamp


def Insert(tubeName):
    data = pd.read_csv("data/pollution/"+tubeName+".csv")

    data = data.reset_index()  # make sure indexes pair with number of rows

    InsertDataToDB = False #Only set to true once file has been run, the TimeStamps DataFrame looks correct and no errors are thrown

    PollutionData = pd.DataFrame()
    PollutionData['Timestamp'] = data[' Date'] + ' ' + data[' Time']
    PollutionData['PM25'] = data[' PM2.5']
    PollutionData['Humidity'] = data[' Humidity']
    PollutionData['Temperature'] = data[' Temp.']
    PollutionData['CO2'] = data[' CO2']
    PollutionData['Pressure'] = data[' Baro']
    PollutionData['HealthIndex'] = data[' Health Index']

    for index, row in PollutionData.iterrows():

        TSData = Timestamp.GetClosest(ConvertDateTimeToTimestamp(row['Timestamp']))
        if (TSData == None):
            continue;

        TSid = TSData[0]

        co2 = CO2(TSid, row['CO2'])
        if InsertDataToDB:
            co2.insert()

        pm25 = PM25(TSid, row['PM25'])
        if InsertDataToDB:
            pm25.insert()

        humidity = Humidity(TSid, row['Humidity'])
        if InsertDataToDB:
            humidity.insert()

        temp = Temperature(TSid, row['Temperature'])
        if InsertDataToDB:
            temp.insert()

        pressure = Pressure(TSid, row['Pressure'])
        if InsertDataToDB:
            pressure.insert()

        HI = HealthIndex(TSid, row['HealthIndex'])
        if InsertDataToDB:
            HI.insert()