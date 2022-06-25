import pandas as pd
from core.objects.Timestamp import Timestamp
from core.objects.pollution.CO2 import CO2
from core.objects.pollution.Humidity import Humidity
from core.objects.pollution.Pressure import Pressure
from core.objects.pollution.PM25 import PM25
from core.objects.pollution.HealthIndex import HealthIndex
from core.objects.pollution.Temperature import Temperature
from core.utils.DBConnector import execute_mutation
from core.utils.TimestampConverter import ConvertDateTimeToTimestamp


def Insert(tubeName):
    data = pd.read_csv("data/pollution/"+tubeName+".csv")

    data = data.reset_index()  # make sure indexes pair with number of rows

    InsertDataToDB = True #Only set to true once file has been run, the TimeStamps DataFrame looks correct and no errors are thrown

    PollutionData = pd.DataFrame()
    PollutionData['Timestamp'] = data[' Date'] + ' ' + data[' Time']
    PollutionData['PM25'] = data[' PM2.5']
    PollutionData['Humidity'] = data[' Humidity']
    PollutionData['Temperature'] = data[' Temp.']
    PollutionData['CO2'] = data[' CO2']
    PollutionData['Pressure'] = data[' Baro']
    PollutionData['HealthIndex'] = data[' Health Index']

    CompiledQuery = None
    CompiledData = []

    for index, row in PollutionData.iterrows():

        TSData = Timestamp.GetClosest(ConvertDateTimeToTimestamp(row['Timestamp']))
        if (TSData == None):
            continue;

        TSid = TSData[0]

        co2 = CO2(TSid, row['CO2'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = co2.insertToCompile(CompiledQuery, CompiledData)

        pm25 = PM25(TSid, row['PM25'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = pm25.insertToCompile(CompiledQuery, CompiledData)

        humidity = Humidity(TSid, row['Humidity'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = humidity.insertToCompile(CompiledQuery, CompiledData)

        temp = Temperature(TSid, row['Temperature'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = temp.insertToCompile(CompiledQuery, CompiledData)
        pressure = Pressure(TSid, row['Pressure'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = pressure.insertToCompile(CompiledQuery, CompiledData)

        HI = HealthIndex(TSid, row['HealthIndex'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = HI.insertToCompile(CompiledQuery, CompiledData)


    execute_mutation(CompiledQuery, CompiledData)
    print(tubeName + " - pollution inserted.")