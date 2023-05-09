import pandas as pd
from core.objects.Timestamp import Timestamp
from core.objects.temperature.DP import DP
from core.objects.temperature.WET import WET
from core.objects.temperature.WBGT import WBGT
from core.objects.temperature.TA import TA
from core.objects.temperature.TG import TG
from core.objects.temperature.Humidity import Humidity
from core.utils.DBConnector import execute_mutation
from core.utils.TimestampConverter import ConvertDateTimeToTimestamp

# This inserter gets the closest timestamp for every data point in the temperature data files and inserts the data into the database if a related timestamp is found.

def Insert(tubeName):
    # Loads the data from the csv in a given directory
    data = pd.read_csv("data/temperature/"+tubeName+".csv")

    data = data.reset_index()  # Make sure indexes pair with number of rows

    InsertDataToDB = True # Only set to true once file has been run, the TimeStamps DataFrame looks correct and no errors are thrown

    # Converts the loaded csv data into a DataFrame which is easier to process
    TemperatureData = pd.DataFrame()
    TemperatureData['Timestamp'] = data['Date'] + ' ' + data['Time']
    TemperatureData['WBGT'] = data['Value']
    TemperatureData['Humidity'] = data['Value.1']
    TemperatureData['TA'] = data['Value.2']
    TemperatureData['TG'] = data['Value.3']
    TemperatureData['WET'] = data['Value.4']
    TemperatureData['DP'] = data['Value.5']

    # Setup empty objects and arrays
    CompiledQuery = None
    CompiledData = []

    # Iterate through every line of temperature data
    for index, row in TemperatureData.iterrows():
        # Find closest timestamp in the database to the recorded line
        TSData = Timestamp.GetClosest(ConvertDateTimeToTimestamp(row['Timestamp']))

        # If none found, exclude row
        if (TSData == None):
            continue

        TSid = TSData[0]

        # Create new object for each type of temperature data and insert object into database
        dp = DP(TSid, row['DP'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = dp.insertToCompile(CompiledQuery, CompiledData)

        wet = WET(TSid, row['WET'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = wet.insertToCompile(CompiledQuery, CompiledData)

        ta = TA(TSid, row['TA'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = ta.insertToCompile(CompiledQuery, CompiledData)

        tg = TG(TSid, row['TG'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = tg.insertToCompile(CompiledQuery, CompiledData)

        wbgt = WBGT(TSid, row['WBGT'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = wbgt.insertToCompile(CompiledQuery, CompiledData)

        humidity = Humidity(TSid, row['Humidity'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = humidity.insertToCompile(CompiledQuery, CompiledData)

    # Execute compiled query to action creation of rows in DB
    execute_mutation(CompiledQuery, CompiledData)
    print(tubeName + " - temperature inserted.")