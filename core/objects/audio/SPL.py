from core.objects.Data import Data
import core.Consts as Consts


class SPL(Data):
    def __init__(self, TimestampID, DataValue):
        #Columns and other variables
        self.TimestampID = TimestampID
        self.DataValue = DataValue

        #Sets up DB object
        super().__init__(TimestampID, Consts.SOUND_SPL, DataValue, 'Sound', 'dB')

