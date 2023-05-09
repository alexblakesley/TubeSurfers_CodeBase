import pandas as pd
from core.objects.Timestamp import Timestamp
from core.utils.DBConnector import execute_mutation
from core.utils.TimestampConverter import ConvertDateTimeToTimestamp

# This inserter reads the timings and creates a series of half second intervals between each station which acts as the resolution of our dataset.
# The timings data contains the time at which the tube train left arrived and left each station, and so from this, a 0.5s series of timestamps can be created from when the recording started until it was stopped and for each timestamp a previous and next station can be assigned to it, and inserted into the database.
# At timestamps where the train was stopped in a station, both the previous and next station is the current station it is stopped at.

def Insert(csvName, tubeName, Date, Leg = ""):
    # Loads the data from the csv in a given directory
    CSVFileName = tubeName + "_" + csvName + str(Leg) + ".csv"
    data = pd.read_csv("data/timings/" + CSVFileName)

    data = data.reset_index()  # Make sure indexes pair with number of rows

    TimeStep = 0.5 #s
    TubeLine = tubeName
    InsertDataToDB = True # Only set to true once file has been run, the TimeStamps DataFrame looks correct and no errors are thrown

    # Converts the loaded csv data into a DataFrame which is easier to process
    Stations = pd.DataFrame()
    Stations['PrevStation'] = data['Segment'].shift(1)
    Stations['Departure'] = data['Departure'].shift(1)
    Stations['NextStation'] = data['Segment']
    Stations['Arrival'] = data['Arrival']

    # Setup empty objects and arrays
    CompiledQuery = None
    CompiledData = []
    StationNames = []
    TimeStamps = pd.DataFrame(columns=['index', 'Timestamp', 'FromStation', 'ToStation', 'TubeLine'])

    # Iterate through each station on the line
    for index, row in Stations.iterrows():
        FromStation = row['PrevStation']
        ToStation = row['NextStation']

        # Add station to stations names array
        if (isinstance(FromStation, str) and FromStation not in StationNames):
            StationNames.append(FromStation)

        if (isinstance(ToStation, str) and ToStation not in StationNames):
            StationNames.append(ToStation)

        # Get departure and arrival timestamp if they exist for the station, else skip
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

        # Get the departure time from the next station, if a next station exists, in order to allow for generating timestamps whilst stationary in a station
        if (index < len(Stations.index)-1):
            NextDeptTime = Stations['Departure'][index + 1]
            if (not isinstance(NextDeptTime, str)):
                continue
            NextDeptDateTimeString = Date + ' ' +NextDeptTime
            NextDeptTimeStamp = ConvertDateTimeToTimestamp(NextDeptDateTimeString)
        else:
            NextDeptTimeStamp = ArrivalTimestamp

        # Inbetween stations: so iterature through 0.5s timestamps from the departure time until the arrival time
        Time = DepartureTimestamp
        Index = 0
        while Time <= ArrivalTimestamp:
            # Foreach timestamp in iterator add a new timestamp to the DataFrame
            # Purely used for debugging and analysis
            TimeStamps = pd.concat([TimeStamps, pd.DataFrame.from_records([{
                'index': Index,
                'Timestamp': Time,
                'FromStation': FromStation,
                'ToStation': ToStation,
                'TubeLine': TubeLine,
            }])])

            # Create timestamp object and check station names are valid
            TS = Timestamp(Time, TubeLine, FromStation, ToStation, Index)
            TS.checkStationNames(csvFile=CSVFileName)
            
            # Insert created object into DB
            if InsertDataToDB:
                CompiledQuery, CompiledData = TS.insertToCompile(CompiledQuery, CompiledData)

            # Increase index and time by timestep
            Time += TimeStep
            Index += 1



        # Stationary at a station: so iterature through 0.5s timestamps from the arrival time until the departure time
        Index = 0
        while Time < NextDeptTimeStamp:
            # Foreach timestamp in iterator add a new timestamp to the DataFrame
            # Purely used for debugging and analysis
            TimeStamps = pd.concat([TimeStamps, pd.DataFrame.from_records([{
                'index': Index,
                'Timestamp': Time,
                'FromStation': ToStation,
                'ToStation': ToStation,
                'TubeLine': TubeLine,
            }])])

            # Create timestamp object and check station names are valid
            TS = Timestamp(Time, TubeLine, ToStation, ToStation, Index)
            TS.checkStationNames(csvFile=CSVFileName)
            
            # Insert created object into DB
            if InsertDataToDB:
                CompiledQuery, CompiledData = TS.insertToCompile(CompiledQuery, CompiledData)

            # Increase index and time by timestep
            Time += TimeStep
            Index += 1

    execute_mutation(CompiledQuery, CompiledData)
    print(tubeName + ": " + csvName + str(Leg) + " - timestamps inserted.")
