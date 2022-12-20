from core.objects.Data import Data
import core.Consts as Consts


class Thermal(Data):
    def __init__(self, TimestampID, DataValue, participantID):
        #Columns and other variables
        self.TimestampID = TimestampID
        self.DataValue = DataValue
        self.participantID = participantID

        #Sets up DB object
        super().__init__(TimestampID, Consts.QUESTIONNAIRE_THERMAL, DataValue, Consts.QUESTIONNAIRE, '-', participantID)

