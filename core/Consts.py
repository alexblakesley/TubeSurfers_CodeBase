import json
import os

  
# gives the path of this file
path = os.path.realpath(__file__)
# gives the directory where this file exists
dir = os.path.dirname(path)

with open(dir+'/Consts.json') as json_file:
    jsonConsts = json.load(json_file)

STATION_NAMES = jsonConsts['Stations']

Lines = jsonConsts['Lines']
LINE_BAKERLOO = Lines["Bakerloo"]
LINE_CENTRAL = Lines["Central"]
LINE_CIRCLE = Lines["Circle"]
LINE_DISTRICT = Lines["District"]
LINE_HAMMERSMITH_CITY = Lines["Hammersmith & City"]
LINE_JUBILEE = Lines["Jubilee"]
LINE_METROPOLITAN = Lines["Metropolitan"]
LINE_NORTHERN = Lines["Northern"]
LINE_PICCADILLY = Lines["Piccadilly"]
LINE_VICTORIA = Lines["Victoria"]
LINE_WATERLOO_CITY = Lines["Waterloo & City"]

DataTypes = jsonConsts['DataTypes']

PollutionDataTypes = DataTypes['Pollution']
POLLUTION_CO2 = PollutionDataTypes["CO2"]
POLLUTION_TEMPERATURE = PollutionDataTypes["Temperature"]
POLLUTION_HEALTH_INDEX = PollutionDataTypes["HealthIndex"]
POLLUTION_PM_25 = PollutionDataTypes["PM25"]
POLLUTION_HUMIDITY = PollutionDataTypes["Humidity"]
POLLUTION_PRESSURE = PollutionDataTypes["Pressure"]

TemperatureDataTypes = DataTypes['Temperature']
TEMPERATURE_DP = TemperatureDataTypes["DP"]
TEMPERATURE_TA = TemperatureDataTypes["TA"]
TEMPERATURE_TG = TemperatureDataTypes["TG"]
TEMPERATURE_WET = TemperatureDataTypes["WET"]
TEMPERATURE_HUMIDITY = TemperatureDataTypes["Humidity"]
TEMPERATURE_WBGT = TemperatureDataTypes["WBGT"]
