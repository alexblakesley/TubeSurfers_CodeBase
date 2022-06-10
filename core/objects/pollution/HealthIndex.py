from core.objects.Data import Data
import core.Consts as Consts


class HealthIndex(Data):
    def __init__(self, TimestampID, DataValue):
        #Columns and other variables
        self.TimestampID = TimestampID
        self.DataValue = DataValue

        #Sets up DB object
        super().__init__(TimestampID, Consts.POLLUTION_HEALTH_INDEX, DataValue, 'Pollution', None)

