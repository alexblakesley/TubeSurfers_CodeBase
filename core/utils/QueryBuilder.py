
def BuildQuery(query, tableName, varDict) -> str:
    query = query.replace("table_name", tableName)

    if ("columns" in varDict):
        if (varDict["columns"]):
            query = query.replace("columns", ",".join(varDict["columns"]))
        else :
            query = query.replace("(columns)", "*")

    if ("data" in varDict):
        dataString = compileDataString(varDict['data'])
        query = query.replace("data", dataString)

    if ("wheres" in varDict):
        if (varDict["wheres"]):
            query = query.replace("wheres", varDict["wheres"])
        else :
            query = query.replace("(wheres)", "1=1")

    if ("sets" in varDict):
        setObj = varDict["sets"]
        setString = compileSetString(setObj["columns"], setObj["data"])
        query = query.replace("sets", setString)
    
    return query


def BuildQueryComplex(query, varDict) -> str:
    for key in varDict:
        query = query.replace('('+key+')', '"'+varDict[key]+'"')

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

