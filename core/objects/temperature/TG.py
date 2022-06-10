from core.objects.Data import Data
import core.Consts as Consts


class TG(Data):
    def __init__(self, TimestampID, DataValue):
        #Columns and other variables
        self.TimestampID = TimestampID
        self.DataValue = DataValue

        #Sets up DB object
        super().__init__(TimestampID, Consts.TEMPERATURE_TG, DataValue, "Temperature", 'DegreeC')

