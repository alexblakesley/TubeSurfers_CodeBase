from multiprocessing import connection
import mysql.connector
from mysql.connector import Error
import pandas as pd


def create_server_connection(host_name, user_name, user_password, db_name):
    connection = None
    try:
        connection = mysql.connector.connect(
            host=host_name,
            user=user_name,
            passwd=user_password,
            database=db_name
        )
        print("MySQL Database connection successful")
    except Error as err:
        print(f"Error: '{err}'")

    return connection

def connectToDB():
    connection = create_server_connection('tubesurfers-db.cql9ooxely3d.eu-west-2.rds.amazonaws.com','masterUsername','TubeSurfers1234!','TubeSurfers_DB')
    return connection

def execute_query(query):
    connection = connectToDB()
    cursor = connection.cursor()

    try:
        cursor.execute(query)
        connection.commit()
        return cursor.fetchall()
    except Error as err:
        print(f"Error: '{err}'")
    


def execute_mutation(query, data = None):
    connection = connectToDB()
    cursor = connection.cursor()

    if (data == None):
        try:
            cursor.execute(query)
            connection.commit()
            return cursor.lastrowid
        except Error as err:
            print(f"Error: '{err}'")
    else:
        try:
            cursor.executemany(query, data)
            connection.commit()
            return cursor.lastrowid
        except Error as err:
            print(f"Error: '{err}'")


