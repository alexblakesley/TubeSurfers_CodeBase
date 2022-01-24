
def BuildQuery(query, tableName, varDict) -> str:
    query = query.replace("table_name", tableName)

    if ("columns" in varDict):
        query = query.replace("column_list", ",".join(varDict["columns"]))

    if ("data" in varDict):
        dataString = compileDataString(varDict['data'])
        query = query.replace("data_list", dataString)

    if ("wheres" in varDict):
        query = query.replace("wheres", varDict["wheres"])

    if ("sets" in varDict):
        setObj = varDict["sets"]
        setString = compileSetString(setObj["columns"], setObj["data"])
        query = query.replace("sets", setString)
    
    return query


def compileSetString(columns, data) -> str:
    #creates string of which variables to set
    string = ""
    connectorString = ", "
    index = 0
    firstItem = True
    for column in columns:
        if (firstItem):
            string = string + "`" + columns[index] + "` = '" + data[index] + "'"
            firstItem = False
        else:
            string = string + connectorString + "`" + columns[index] + "` = '" + data[index] + "'"
        
        index = index+1

    return string


def compileDataString(data) -> str:
    #creates data list to match columns
    string = ""
    dataSymbol = "%s"
    connectorString = ", "
    firstItem = True
    for dataItem in data:
        #Creates string which replaces data_list of the format (%s, %s, %s)
        #Data is then inserted into this pattern when executing query
        if (firstItem):
            string = dataSymbol
            firstItem = False
        else:
            string = string + connectorString + dataSymbol

    return string

