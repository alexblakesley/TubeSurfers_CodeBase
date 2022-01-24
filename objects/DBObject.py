from utils.DBConnector import execute_query
import utils.QueryBuilder as QB

class DBObject:
    def __init__(self, TableName, columns):
        self.DBid = None #DO NOT set this variable manually, it should only be set through fetch calls
        self.tableName = TableName
        self.columns = columns

    def insert(self):
        #SQL Query to be run
        baseInsertQuery = "INSERT INTO `TubeSurfers_DB`.`table_name` (column_list) VALUES (data_list);"

        data = self.compileData()
        query = QB.BuildQuery(baseInsertQuery, self.tableName, {"columns": self.columns, "data": data})

        return execute_query(query, [data])

    def update(self):
        baseUpdateQuery = "UPDATE `TubeSurfers_DB`.`table_name` SET sets WHERE (wheres);"
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
        return execute_query(query)

    def fetch():
        baseUpdateQuery = "SELECT (column_list) FROM `TubeSurfers_DB`.`table_name` WHERE (wheres);"

    

    def compileData(self) -> list:
        #creates data list to match columns
        data = []
        for column in self.columns:
            data.append(getattr(self, column))
        return data





