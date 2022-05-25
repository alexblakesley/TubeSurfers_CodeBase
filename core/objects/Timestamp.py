from core.objects.DBObject import DBObject


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

        self.AcceptedStations = ['Euston', 'Euston Road', 'Waterloo', 'West Ham', 'Bromley-by-Bow', 'Bow Road', 'Mile End', 'Stepney Green', 'Whitechapel', 'Aldgate East', 'Tower Hill', 'Monument', 'Cannon Street', 'Mansion House', 'Blackfriars', 'Temple', 'Embankment', 'Westminster', "St James's Park", 'Victoria', 'Sloane Square', 'South Kensington', 'Gloucester Road', "Earl's Court", 'West Kensington', 'Ravenscourt Park', 'Stamford Brook', 'Turnham Green', 'Hammersmith', "Baron's Court", 'Knightsbridge', 'Hyde Park', 'Green Park', 'Piccadilly Circus', 'Leicester Square', 'Covent Garden', 'Holborn', 'Russell Square', "King's Cross St. Pancras", 'Caledonian Road', 'Holloway Road', 'Arsenal', 'Finsbury Park', 'Manor House']

        #Sets up DB object
        super().__init__(DB_Table_Name, DB_Columns)
        

    def checkStationNames(self) -> bool:
        if self.FromStation not in self.AcceptedStations:
            print("Station Not Recognised. Please see list of accepted stations in Timestamp.py. A Station Names Array should have been generated during this run, please send thep printed string to Alex and he will add to DB. Station Name: "+self.FromStation)
            return False

        if self.ToStation not in self.AcceptedStations:
            print("Station Not Recognised. Please see list of accepted stations in Timestamp.py. A Station Names Array should have been generated during this run, please send thep printed string to Alex and he will add to DB. Station Name: "+self.ToStation)
            return False
        
        return True


    
"""  @staticmethod
def GetTimestamps(fromTime, ToTime, TubeLine = None): """
