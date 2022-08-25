import pandas as pd
from core.objects.Timestamp import Timestamp
from core.objects.acceleration.Totalacceleration import Totalacceleration
from core.utils.DBConnector import execute_mutation
from core.utils.TimestampConverter import ConvertDateTimeToTimestampWithMs


def Insert(filename):
    data = pd.read_csv("data/acceleration/"+filename)

    data = data.reset_index()  # make sure indexes pair with number of rows

    InsertDataToDB = True #Only set to true once file has been run, the TimeStamps DataFrame looks correct and no errors are thrown

    AccelerationData = pd.DataFrame()
    AccelerationData['Timestamp'] = data['Time']
    AccelerationData['Totalacceleration'] = data['tot_acc']

    first_timestamp = ConvertDateTimeToTimestampWithMs(AccelerationData['Timestamp'][0])
    last_timestamp = ConvertDateTimeToTimestampWithMs(AccelerationData['Timestamp'].iloc[len(AccelerationData.index) - 1])

    duration = last_timestamp - first_timestamp

    CompiledQuery = None
    CompiledData = []
    IsTimestampRejected = False
    print(filename)
    # print(AccelerationData['Timestamp'][0])


    for index, row in AccelerationData.iterrows():

        TSData = Timestamp.GetClosest(ConvertDateTimeToTimestampWithMs(row['Timestamp']) - duration)
        if (TSData == None):
            if IsTimestampRejected:
                continue;
            IsTimestampRejected = True
            # print("START: " + row['Timestamp'])
            continue;
        else:
            if IsTimestampRejected:
                IsTimestampRejected = False
                # print(" END : " + row['Timestamp'])



        TSid = TSData[0]

        totalacceleration = Totalacceleration(TSid, row['Totalacceleration'])
        if InsertDataToDB:
            CompiledQuery, CompiledData = totalacceleration.insertToCompile(CompiledQuery, CompiledData)


    print(AccelerationData['Timestamp'].iloc[len(AccelerationData.index) - 1])
    execute_mutation(CompiledQuery, CompiledData)
    # print(filename + " - acceleration inserted.")