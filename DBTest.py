from datetime import datetime
from time import time
from objects.Timestamp import Timestamp
from utils.DBConnector import connectToDB, create_server_connection, execute_query


#ret = execute_query(connectToDB(), "INSERT INTO `TubeSurfers_DB`.`Timestamps` (`Timestamp`, `TubeLine`, `FromStation`, `ToStation`) VALUES ('1643048687.182575', 'N', 'Euston', 'Euston Road');")

ts = Timestamp('1643048687.182529', 'N', 'Euston', 'Euston')
ts.insert()