import pandas as pd
from core.objects.Timestamp import Timestamp
from core.objects.audio.SPL import SPL
from core.utils.DBConnector import execute_mutation
import datetime


def Insert(fileName):

    data = pd.read_csv("data/audio/"+fileName)

    data = data.reset_index()  # make sure indexes pair with number of rows

    InsertDataToDB = True #Only set to true once file has been run, the TimeStamps DataFrame looks correct and no errors are thrown

    AudioData = pd.DataFrame()
    AudioData['Timestamp'] = data['Timestamps']
    AudioData['SPL'] = data['spl']


    CompiledQuery = None
    CompiledData = []

    print(fileName)
    print(str(datetime.datetime.fromtimestamp(int(AudioData['Timestamp'][0]))))

    IsTimestampRejected = False

    for index, row in AudioData.iterrows():

        TSData = Timestamp.GetClosest(str(row['Timestamp']))
        if (TSData == None):
            if IsTimestampRejected:
                continue;
            IsTimestampRejected = True
            print("START: " + str(datetime.datetime.fromtimestamp(int(row['Timestamp']))))
            continue;
        else:
            if IsTimestampRejected:
                IsTimestampRejected = False
                print(" END : " + str(datetime.datetime.fromtimestamp(int(row['Timestamp']))))

        TSid = TSData[0]

        spl = SPL(TSid, float(row['SPL']))
        if InsertDataToDB:
            CompiledQuery, CompiledData = spl.insertToCompile(CompiledQuery, CompiledData)

    print(str(datetime.datetime.fromtimestamp(int(AudioData['Timestamp'].iloc[len(AudioData.index) - 1]))))

    execute_mutation(CompiledQuery, CompiledData)
    print(fileName + " - sound inserted.")