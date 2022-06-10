import pandas as pd
from core.objects.Timestamp import Timestamp
from core.utils.TimestampConverter import ConvertDateTimeToTimestamp


def Insert(csvName, tubeName, Date, Leg = ""):
    CSVFileName = tubeName + "_" + csvName + str(Leg) + ".csv"
    data = pd.read_csv("data/timings/" + CSVFileName)

    data = data.reset_index()  # make sure indexes pair with number of rows

    TimeStep = 0.5 #s
    TubeLine = tubeName
    InsertDataToDB = True #Only set to true once file has been run, the TimeStamps DataFrame looks correct and no errors are thrown

    Stations = pd.DataFrame()
    Stations['PrevStation'] = data['Segment'].shift(1)
    Stations['Departure'] = data['Departure'].shift(1)
    Stations['NextStation'] = data['Segment']
    Stations['Arrival'] = data['Arrival']

    StationNames = []
    TimeStamps = pd.DataFrame(columns=['index', 'Timestamp', 'FromStation', 'ToStation', 'TubeLine'])
    for index, row in Stations.iterrows():
        FromStation = row['PrevStation']
        ToStation = row['NextStation']

        if (isinstance(FromStation, str) and FromStation not in StationNames):
            StationNames.append(FromStation)

        if (isinstance(ToStation, str) and ToStation not in StationNames):
            StationNames.append(ToStation)

        DeptTime = row['Departure']
        if (not isinstance(DeptTime, str)):
            continue
        DeptDateTimeString = Date + ' ' +DeptTime
        DepartureTimestamp = ConvertDateTimeToTimestamp(DeptDateTimeString)


        ArrTime = row['Arrival']
        if (not isinstance(ArrTime, str)):
            continue
        ArrDateTimeString = Date + ' ' +ArrTime
        ArrivalTimestamp = ConvertDateTimeToTimestamp(ArrDateTimeString)

        if (index < len(Stations.index)-1):
            NextDeptTime = Stations['Departure'][index + 1]
            if (not isinstance(NextDeptTime, str)):
                continue
            NextDeptDateTimeString = Date + ' ' +NextDeptTime
            NextDeptTimeStamp = ConvertDateTimeToTimestamp(NextDeptDateTimeString)
        else:
            NextDeptTimeStamp = ArrivalTimestamp + 60

        Time = DepartureTimestamp
        Index = 0
        while Time <= ArrivalTimestamp:
            TimeStamps = pd.concat([TimeStamps, pd.DataFrame.from_records([{
                'index': Index,
                'Timestamp': Time,
                'FromStation': FromStation,
                'ToStation': ToStation,
                'TubeLine': TubeLine,
            }])])

            TS = Timestamp(Time, TubeLine, FromStation, ToStation, Index)
            TS.checkStationNames(csvFile=CSVFileName)
            
            if InsertDataToDB:
                TS.insert()

            Time += TimeStep
            Index += 1


        Index = 0
        while Time < NextDeptTimeStamp:
            TimeStamps = pd.concat([TimeStamps, pd.DataFrame.from_records([{
                'index': Index,
                'Timestamp': Time,
                'FromStation': ToStation,
                'ToStation': ToStation,
                'TubeLine': TubeLine,
            }])])

            TS = Timestamp(Time, TubeLine, ToStation, ToStation, Index)
            TS.checkStationNames(csvFile=CSVFileName)
            
            if InsertDataToDB:
                TS.insert()

            Time += TimeStep
            Index += 1
