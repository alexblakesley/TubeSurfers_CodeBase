from core.objects.Data import Data


class PM25(Data): #Actual Name is PM2.5
    def __init__(self, TimestampID, DataValue):
        #Columns and other variables
        self.TimestampID = TimestampID
        self.DataValue = DataValue

        #Sets up DB object
        super().__init__(TimestampID, ' PM25', DataValue, 'Pollution', 'ug/m^3')

