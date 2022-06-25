from sqlite3 import Timestamp
from core.utils.DBConnector import execute_mutation, execute_query
import core.utils.QueryBuilder as QB

class DBObject:
    def __init__(self, TableName, columns):
        self.DBid = None #DO NOT set this variable manually, it should only be set through fetch calls
        self.tableName = TableName
        self.columns = columns


    def insert(self, Query = None) -> int:
        """
        Inserts a created DBObject into the DB

        @param self:
        @param Query a larger query string to which this query will be added, however not executed

        @return: int - The ID of the inserted line in the DB
        
        """

        # SQL Query to be run
        baseInsertQuery = "INSERT INTO `ts_db`.`table_name` (columns) VALUES (data);"

        data = self.compileData()
        query = QB.BuildQuery(baseInsertQuery, self.tableName, {
            "columns": self.columns, 
            "data": data
        })

        return execute_mutation(query, [data])


    def insertToCompile(self, Query, CompiledData) -> int:
        """
        Inserts a created DBObject into the DB

        @param self:
        @param Query a query string to which this query will be added, however not executed
        @param CompiledData a larger data array to which this query data will be added, however not executed

        @return: int - The ID of the inserted line in the DB
        
        """

        # SQL Query to be run
        baseInsertQuery = "INSERT INTO `ts_db`.`table_name` (columns) VALUES (data);"

        data = self.compileData()

        if (Query == None):
            Query = QB.BuildQuery(baseInsertQuery, self.tableName, {
                "columns": self.columns, 
                "data": data
            })
        
        CompiledData.append(data)

        return Query, CompiledData

    def update(self) -> int:
        """
        Updates a DBObject in the DB

        @param self:

        @return: int - The ID of the updated line in the DB
        
        """


        baseUpdateQuery = "UPDATE `ts_db`.`table_name` SET sets WHERE (wheres);"
        if (self.DBid == None):
            raise Exception("DBid must be set from a fetch call before update can be run")

        data = self.compileData()
        query = QB.BuildQuery(baseUpdateQuery, self.tableName, {
            "columns": self.columns, 
            "data": data, 
            "wheres": "`DBid` = '"+str(self.DBid)+"'", 
            "sets": {
                "columns": self.columns, 
                "data": data
            }
        })
        return execute_mutation(query)

    def fetch(self, wheres = None):
        columns = ('DBid', *self.columns)
        baseUpdateQuery = "SELECT columns FROM `ts_db`.`table_name` WHERE (wheres) "
        query = QB.BuildQuery(baseUpdateQuery, self.tableName, {
            "columns": columns, 
            "wheres": wheres,
        })
        return execute_query(query)

    def compileData(self) -> list:
        #creates data list to match columns
        data = []
        for column in self.columns:
            data.append(getattr(self, column))
        return data




