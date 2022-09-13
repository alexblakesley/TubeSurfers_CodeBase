from core.objects.DBObject import DBObject
from core.utils.DBConnector import execute_query
import core.utils.QueryBuilder as QB

class Data(DBObject):
    def __init__(self, TimestampID = None, DataName = None, DataValue = None, DataType = None, Units = None, SensorID = None):
        #Columns and other variables

        self.TimestampID = TimestampID
        self.DataName = DataName
        self.DataValue = DataValue
        self.DataType = DataType
        self.Units = Units
        self.SensorID = SensorID

        #Set DB Variables
        DB_Table_Name = "Data"
        DB_Columns = ("TimestampID", "DataName", "DataValue", "DataType", "Units", "SensorID")


        #Sets up DB object
        super().__init__(DB_Table_Name, DB_Columns)


    @staticmethod
    def FetchDataBetweenStations(FromStation, ToStation, TubeLine, DataType, DataName):
        baseUpdateQuery = 'SELECT * FROM `ts_db`.`Timestamps` LEFT JOIN `ts_db`.`Data` ON `ts_db`.`Timestamps`.`DBid` = `ts_db`.`Data`.`TimestampID` WHERE `FromStation` = (fromStation) AND `ToStation` = (toStation) AND `TubeLine` = (tubeLine) AND `DataType` = (dataType) AND `DataName` = (dataName)'

        query = QB.BuildQueryComplex(baseUpdateQuery, {
            'fromStation': FromStation,
            'toStation': ToStation,
            'tubeLine': TubeLine,
            'dataType': DataType,
            'dataName': DataName,
        })

        return execute_query(query)


    @staticmethod
    def FetchTimestamps(FromStation, ToStation, TubeLine):
        baseUpdateQuery = 'SELECT MIN(`Timestamp`) FROM `ts_db`.`Timestamps` WHERE `FromStation` = (fromStation) AND `ToStation` = (toStation) AND `TubeLine` = (tubeLine)'
        
        query = QB.BuildQueryComplex(baseUpdateQuery, {
            'fromStation': FromStation,
            'toStation': ToStation,
            'tubeLine': TubeLine
        })

        return execute_query(query)

