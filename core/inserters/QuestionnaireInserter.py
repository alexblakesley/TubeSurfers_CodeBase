import pandas as pd
from core.objects.Timestamp import Timestamp
from core.objects.questionnaire.Average import Average
from core.objects.questionnaire.Acoustic import Acoustic
from core.objects.questionnaire.Thermal import Thermal
from core.objects.questionnaire.Airquality import Airquality
from core.objects.questionnaire.Acceleration import Acceleration
from core.objects.questionnaire.Vibration import Vibration
from core.objects.questionnaire.Jerks import Jerks
from core.objects.questionnaire.Crowdedness import Crowdedness
from core.utils.DBConnector import execute_mutation

# This inserter gets a segment timestamp for every entry in the questionnaire data files and inserts the data.

def Insert(filename):
    # Loads the data from the csv in a given directory
    data = pd.read_csv("data/questionnaire/"+filename)

    data = data.reset_index()  # Make sure indexes pair with number of rows

    InsertDataToDB = True # Only set to true once file has been run, the TimeStamps DataFrame looks correct and no errors are thrown

    # Converts the loaded csv data into a DataFrame which is easier to process
    QuestionnaireData = pd.DataFrame()
    QuestionnaireData["segment_start"] = data["segment start"]
    QuestionnaireData["segment_end"] = data["segement end"]
    QuestionnaireData["average"] = data["average riding comfort"]
    QuestionnaireData["acoustic"] = data["acoustic comfort"]
    QuestionnaireData["thermal"] = data["thermal comfort"]
    QuestionnaireData["air_quality"] = data["air quality/ventilation"]
    QuestionnaireData["acceleration"] = data["acceleration & braking"]
    QuestionnaireData["vibration"] = data["vibration"]
    QuestionnaireData["jerks"] = data["jerks/shaking"]
    QuestionnaireData["crowdedness"] = data["crowdedness"]
    QuestionnaireData["participant_id"] = data["participant id"]
    QuestionnaireData["line"] = data["line"]
    
    # Setup empty objects and arrays
    CompiledQuery = None
    CompiledData = []

    # Iterate through every line of questionnaire data
    for index, row in QuestionnaireData.iterrows():
        # Find a timestamp based on the related segment of the questionnaire entry
        start = row["segment_start"].strip()
        end = row["segment_end"].strip()
        line = row["line"].strip()
        TSid = Timestamp.GetSegment(start,end,line)

        # If none found, exclude row
        if (TSid == None):
            continue

        pid = row["participant_id"]

        # Create new object for each type of questionnaire data and insert object into database
        average = Average(TSid, 6-row["average"], pid)
        if InsertDataToDB:
            CompiledQuery, CompiledData = average.insertToCompile(CompiledQuery, CompiledData)

        acoustic = Acoustic(TSid, 6-row["acoustic"], pid)
        if InsertDataToDB:
            CompiledQuery, CompiledData = acoustic.insertToCompile(CompiledQuery, CompiledData)

        thermal = Thermal(TSid, 6-row["thermal"], pid)
        if InsertDataToDB:
            CompiledQuery, CompiledData = thermal.insertToCompile(CompiledQuery, CompiledData)

        airquality = Airquality(TSid, 6-row["air_quality"], pid)
        if InsertDataToDB:
            CompiledQuery, CompiledData = airquality.insertToCompile(CompiledQuery, CompiledData)

        acceleration = Acceleration(TSid, 6-row["acceleration"], pid)
        if InsertDataToDB:
            CompiledQuery, CompiledData = acceleration.insertToCompile(CompiledQuery, CompiledData)

        vibration = Vibration(TSid, 6-row["vibration"], pid)
        if InsertDataToDB:
            CompiledQuery, CompiledData = vibration.insertToCompile(CompiledQuery, CompiledData)

        jerks = Jerks(TSid, 6-row["jerks"], pid)
        if InsertDataToDB:
            CompiledQuery, CompiledData = jerks.insertToCompile(CompiledQuery, CompiledData)

        crowdedness = Crowdedness(TSid, row["crowdedness"], pid)
        if InsertDataToDB:
            CompiledQuery, CompiledData = crowdedness.insertToCompile(CompiledQuery, CompiledData)

    # Execute compiled query to action creation of rows in DB
    execute_mutation(CompiledQuery, CompiledData)
    print(filename + " - questionnaire inserted.")