import pandas as pd
from core.objects.Timestamp import Timestamp
from core.objects.audio.SPL import SPL
from core.utils.DBConnector import execute_mutation

# This inserter gets the closest timestamp for every data point in the adio data files and inserts the data into the database if a related timestamp is found.

def Insert(fileName):
    # Loads the data from the csv in a given directory
    data = pd.read_csv("data/audio/"+fileName)

    data = data.reset_index()  # Make sure indexes pair with number of rows

    InsertDataToDB = True # Only set to true once file has been run, the TimeStamps DataFrame looks correct and no errors are thrown

    # Converts the loaded csv data into a DataFrame which is easier to process
    AudioData = pd.DataFrame()
    AudioData['Timestamp'] = data['Timestamps']
    AudioData['SPL'] = data['spl']

    # Setup empty objects and arrays
    CompiledQuery = None
    CompiledData = []
    IsTimestampRejected = False

    # Iterate through every line of audio data
    for index, row in AudioData.iterrows():
        # Find closest timestamp in the database to the recorded line
        TSData = Timestamp.GetClosest(str(row['Timestamp']))
        
        # If none found, exclude row
        if (TSData == None):
            if IsTimestampRejected:
                continue
            IsTimestampRejected = True
            continue
        else:
            if IsTimestampRejected:
                IsTimestampRejected = False

        TSid = TSData[0]

        # Create new SPL object and insert object into database
        spl = SPL(TSid, float(row['SPL']))
        if InsertDataToDB:
            CompiledQuery, CompiledData = spl.insertToCompile(CompiledQuery, CompiledData)

    # Execute compiled query to action creation of rows in DB
    execute_mutation(CompiledQuery, CompiledData)
    print(fileName + " - sound inserted.")