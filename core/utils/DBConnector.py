from multiprocessing import connection
from django.conf import settings
import mysql.connector
from mysql.connector import Error
import pandas as pd


def create_server_connection(host_name, user_name, user_password, db_name, port = 3306):
    connection = None
    try:
        connection = mysql.connector.connect(
            host=host_name,
            user=user_name,
            passwd=user_password,
            database=db_name,
            port=port,
        )
    except Error as err:
        print(f"Error: '{err}'")

    return connection

def connectToDB():
    connection = create_server_connection(settings.DB_NAME, settings.DB_USERNAME, settings.DB_PASSWORD, settings.DB_DEFAULT_SCHEMA)
    return connection

def execute_query(query):
    connection = connectToDB()
    cursor = connection.cursor(buffered=True)

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
            print("Committed Quey: "+query)
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


