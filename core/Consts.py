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
POLLUTION_CO2 = PollutionDataTypes["CO2"]["name"]
POLLUTION_TEMPERATURE = PollutionDataTypes["Temperature"]["name"]
POLLUTION_HEALTH_INDEX = PollutionDataTypes["HealthIndex"]["name"]
POLLUTION_PM_25 = PollutionDataTypes["PM25"]["name"]
POLLUTION_HUMIDITY = PollutionDataTypes["Humidity"]["name"]
POLLUTION_PRESSURE = PollutionDataTypes["Pressure"]["name"]

TemperatureDataTypes = DataTypes['Temperature']
TEMPERATURE_DP = TemperatureDataTypes["DP"]["name"]
TEMPERATURE_TA = TemperatureDataTypes["TA"]["name"]
TEMPERATURE_TG = TemperatureDataTypes["TG"]["name"]
TEMPERATURE_WET = TemperatureDataTypes["WET"]["name"]
TEMPERATURE_HUMIDITY = TemperatureDataTypes["Humidity"]["name"]
TEMPERATURE_WBGT = TemperatureDataTypes["WBGT"]["name"]

SoundDataTypes = DataTypes['Sound']
SOUND_SPL = SoundDataTypes["SPL"]["name"]
