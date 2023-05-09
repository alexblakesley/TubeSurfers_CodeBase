import pandas as pd
from core.objects.Timestamp import Timestamp
from core.objects.acceleration.Totalacceleration import Totalacceleration
from core.utils.DBConnector import execute_mutation
from core.utils.TimestampConverter import ConvertDateTimeToTimestampWithMs

def Insert(filename):
    # Loads the data from the csv in a given directory
    data = pd.read_csv("data/acceleration/"+filename)

    data = data.reset_index()  # Make sure indexes pair with number of rows

    InsertDataToDB = True # Only set to true once file has been run, the TimeStamps DataFrame looks correct and no errors are thrown

    # Converts the loaded csv data into a DataFrame which is easier to process
    AccelerationData = pd.DataFrame()
    AccelerationData['Timestamp'] = data['Time']
    AccelerationData['Totalacceleration'] = data['tot_acc']

    # Setup empty objects and arrays
    CompiledQuery = None
    CompiledData = []
    IsTimestampRejected = False

    # Iterate through every line of acceleration data
    for index, row in AccelerationData.iterrows():
        # Find closest timestamp in the database to the recorded line
        TSData = Timestamp.GetClosest(ConvertDateTimeToTimestampWithMs(row['Timestamp']))
        
        # If none found, exclude row
        if (TSData == None):
            if IsTimestampRejected:
                continue;
            IsTimestampRejected = True
            continue;
        else:
            if IsTimestampRejected:
                IsTimestampRejected = False

        TSid = TSData[0]

        # Create new total acceleration object and insert object into database
        totalacceleration = Totalacceleration(TSid, row['Totalacceleration'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = totalacceleration.insertToCompile(CompiledQuery, CompiledData)

    # Execute compiled query to action creation of rows in DB
    execute_mutation(CompiledQuery, CompiledData)
    print(filename + " - acceleration inserted.")