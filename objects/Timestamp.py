

from objects.DBObject import DBObject


class Timestamp(DBObject):
    def __init__(self, Timestamp, TubeLine, FromStation, ToStation):
        #Columns and other variables
        self.Timestamp = Timestamp
        self.TubeLine = TubeLine
        self.FromStation = FromStation
        self.ToStation = ToStation

        #Set DB Variables
        DB_Table_Name = "Timestamps"
        DB_Columns = ("Timestamp", "TubeLine", "FromStation", "ToStation")

        #Sets up DB object
        super().__init__(DB_Table_Name, DB_Columns)

    
"""  @staticmethod
def GetTimestamps(fromTime, ToTime, TubeLine = None): """
