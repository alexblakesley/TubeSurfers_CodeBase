# Introduction
Welcome to the TubeSurfers Project.

The goal of the TubeSurfers Project is to create an interactive map to help visualise how a set of different dynamics and environmental factors vary across the London Underground.

A live working version of this repository can be found at: https://tubesurfers.co.uk/

The factors that were included in this study where:
- acceleration (vibration)
- noise
- temperature 
- humitidy
- air quality (including PM2.5, CO2 and health index).

This repository contains the data recorded on the London Underground as well as the code required to recreate the website locally, including a series of docker containers to reproduce the database, web server and PHP-MyAdmin.

The data collected is stored within the repository is stored in the form of a series of folders containing .csv or .txt files. Some of these files were recorded in this format (temperature, pollution, questionnaire and timings), however others (acceeleration and audio) were processed from other formats externally before being saved in this project.
All data used to create the map is stored in the /data folder.

The /core folder contains all backend functionality for the environment including data inserting scripts in the /inserters folders, data processing scripts in the /processors folder, and then utility functions and object structures in the /utils and /objects folders respectively.
When seeking to analyse how the environment interacts with the data the /processors and /inserters folders are the main directories to search.

The /app and /app-php folders contain the tube-map used to create the interactive map, as well as the endpoints for how the web-app requests the data from the backend server.

Below are sections which describe how to install and deploy the TubeSurfers environment.

# Installation
This section contains an installation guide on how to quickly get the tubesurfers environment running locally on your machine.

## Pre-Requisites
Please install the following software before proceeding with the installation guide:
- Docker Desktop
- VSCode

## Local Installation
Run from the root of the project:
```
docker compose build
```

Then:
```
docker compose up
```

Finally in VSCode press:
```
Shift + Ctrl/Command + P
```

Then type/select
```
Remote-Containers: Attach to Running Container
```
And Select TS_App

In new VS Code window, select open folder in explorer and when prompted select the directory:
```
/code/
```
Finally in VSCode press:
```
Shift + Ctrl/Command + P
```

Then type/select
```
Python: Select Interpreter
```
and select the Python 3.8 version


Next, you will need to create your database structure.
To do this, open docker and then open PhPMyAdmin in your browser. Then create a blank SQL script and copy and paste the contents of DB/Full Build.sql into the editor and press Go.

Next run the InsertData.py script from within the Docker container to insert the data into the DB (This will take a while).

Finally, from docker again open up the TS_App in your browser and you should have a fully functioning Map!



# Deployment

If you have a .elasticbeanstalk folder already delete it

Next ensure you have the awsebcli python module installed

If not install via 

```
pip install awsebcli
```

next run:
```
eb init
```

follow the instructions as so:
```
Select a default region
1) us-east-1 : US East (N. Virginia)
2) us-west-1 : US West (N. California)
3) us-west-2 : US West (Oregon)
4) eu-west-1 : EU (Ireland)
5) eu-central-1 : EU (Frankfurt)
6) ap-south-1 : Asia Pacific (Mumbai)
7) ap-southeast-1 : Asia Pacific (Singapore)
8) ap-southeast-2 : Asia Pacific (Sydney)
9) ap-northeast-1 : Asia Pacific (Tokyo)
10) ap-northeast-2 : Asia Pacific (Seoul)
11) sa-east-1 : South America (Sao Paulo)
12) cn-north-1 : China (Beijing)
13) cn-northwest-1 : China (Ningxia)
14) us-east-2 : US East (Ohio)
15) ca-central-1 : Canada (Central)
16) eu-west-2 : EU (London)
17) eu-west-3 : EU (Paris)
18) eu-north-1 : EU (Stockholm)
19) eu-south-1 : EU (Milano)
20) ap-east-1 : Asia Pacific (Hong Kong)
21) me-south-1 : Middle East (Bahrain)
22) af-south-1 : Africa (Cape Town)
(default is 3): 16


Select an application to use
1) TS_App_Docker
2) TubeSurfersAppDocker
3) TubeSurfersAppPythn
4) TubeSurfersAppPython
5) TubeSurfersApp
6) [ Create new Application ]
(default is 6): 4

Alert: The platform version you chose isn't recommended. There's a recommended version in the same platform branch.

Do you wish to continue with CodeCommit? (Y/n): n
```

next run
```
eb status
```

to connect to the running elastic beanstalk instance on the aws instance. (If this is not set up, then this is required and considerably changes the deployment instructions)

finally run
```
eb deploy
```
to complete deployment.