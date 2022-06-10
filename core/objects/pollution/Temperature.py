from core.objects.Data import Data
import core.Consts as Consts


class Temperature(Data):
    def __init__(self, TimestampID, DataValue):
        #Columns and other variables
        self.TimestampID = TimestampID
        self.DataValue = DataValue

        #Sets up DB object
        super().__init__(TimestampID, Consts.POLLUTION_TEMPERATURE, DataValue, 'Pollution', 'DegreeC')

