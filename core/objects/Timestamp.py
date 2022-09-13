from time import time
from unicodedata import decimal
from core.objects.DBObject import DBObject
import core.Consts as Consts


class Timestamp(DBObject):
    def __init__(self, Timestamp = None, TubeLine = None, FromStation = None, ToStation = None, IndexBetweenStations = None):
        #Columns and other variables
        self.Timestamp = Timestamp
        self.TubeLine = TubeLine
        self.FromStation = FromStation
        self.ToStation = ToStation
        self.IndexBetweenStations = IndexBetweenStations

        #Set DB Variables
        DB_Table_Name = "Timestamps"
        DB_Columns = ("Timestamp", "TubeLine", "FromStation", "ToStation", "IndexBetweenStations")

        self.AcceptedStations = Consts.STATION_NAMES

        #Sets up DB object
        super().__init__(DB_Table_Name, DB_Columns)
        

    def checkStationNames(self, **kwargs):
        if self.FromStation not in self.AcceptedStations:
            print("Station Not Recognised. Please see list of accepted stations in Consts.json. A Station Names array should have been generated during this run, please send thep printed string to Alex and he will add to DB. Station Name: "+self.FromStation+". File Name: "+kwargs.get('csvFile'))
            return False

        if self.ToStation not in self.AcceptedStations:
            print("Station Not Recognised. Please see list of accepted stations in Consts.json. A Station Names array should have been generated during this run, please send thep printed string to Alex and he will add to DB. Station Name: "+self.ToStation+". File Name: "+kwargs.get('csvFile'))
            return False
        
        return True

    @staticmethod
    def GetSegment(fromStation, toStation, line):
        TS = Timestamp()

        Where = "FromStation = \"" + fromStation + "\" AND ToStation = \"" + toStation + "\" AND TubeLine = \"" + line + "\""
        ret = TS.fetch(Where)

        if (len(ret) == 0):
            return None

        ts = ret[0][0]

        return ts


    @staticmethod
    def GetClosest(timestamp):
        TS = Timestamp()

        PrevTimestamp = float(timestamp) - 1
        NextTimestamp = float(timestamp) + 1
        Where = "Timestamp > "+ str(PrevTimestamp) + "AND Timestamp < " + str(NextTimestamp)
        ret = TS.fetch(Where)

        if (len(ret) == 0):
            return None

        clostestTS = ret[0];
        for ts in ret:
            if (abs(float(ts[1]) - float(timestamp)) < abs(float(clostestTS[1]) - float(timestamp))):
                clostestTS = ts

        return clostestTS
    

    
"""  @staticmethod
def GetTimestamps(fromTime, ToTime, TubeLine = None): """
