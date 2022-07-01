import pandas as pd
from core.objects.Timestamp import Timestamp
from core.objects.audio.SPL import SPL
from core.utils.DBConnector import execute_mutation


def Insert(fileName):

    data = pd.read_csv("data/audio/"+fileName)

    data = data.reset_index()  # make sure indexes pair with number of rows

    InsertDataToDB = True #Only set to true once file has been run, the TimeStamps DataFrame looks correct and no errors are thrown

    AudioData = pd.DataFrame()
    AudioData['Timestamp'] = data['Timestamps']
    AudioData['SPL'] = data['spl']


    CompiledQuery = None
    CompiledData = []

    for index, row in AudioData.iterrows():

        TSData = Timestamp.GetClosest(str(row['Timestamp']))
        if (TSData == None):
            continue;

        TSid = TSData[0]

        spl = SPL(TSid, float(row['SPL']))
        if InsertDataToDB:
            CompiledQuery, CompiledData = spl.insertToCompile(CompiledQuery, CompiledData)

    execute_mutation(CompiledQuery, CompiledData)
    print(fileName + " - sound inserted.")