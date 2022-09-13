
import core.inserters.TimestampInserter  as TsInserter
import core.inserters.TemperatureInserter as TempInserter
import core.inserters.PollutionInserter as PollInserter
import core.Consts as Consts

def InsertAll():

    ### Insert Bakerloo ###
    TubeName = Consts.LINE_BAKERLOO
    Date = "04/02/2022"
    ## Forward ##
    CSVName = "Elephant&Castle-WillesdenJunction"
    TsInserter.Insert(CSVName, TubeName, Date)

    ## Backward ##
    CSVName = "WillesdenJunction-Elephant&Castle"
    TsInserter.Insert(CSVName, TubeName, Date)
    TsInserter.Insert(CSVName, TubeName, Date, 1)

    # Data #
    TempInserter.Insert(TubeName)
    PollInserter.Insert(TubeName)


    ### Insert Central ###
    TubeName = Consts.LINE_CENTRAL
    Date = "16/02/2022"
    # Forward #
    CSVName = "NorthActon-Stratford"
    TsInserter.Insert(CSVName, TubeName, Date)

    ##Backward #
    CSVName = "Stratford-NorthActon"
    TsInserter.Insert(CSVName, TubeName, Date)

    # Data #
    TempInserter.Insert(TubeName)
    PollInserter.Insert(TubeName)



    ### Insert Circle ###
    TubeName = Consts.LINE_CIRCLE
    # Data & Timestamps Covered by Hammersmith & City and Metropolitan



    ### Insert District ###
    TubeName = Consts.LINE_DISTRICT
    Date = "19/01/2022"

    ## EarlsCourt-EastPutney Branch ##
    # Forward #
    CSVName = "EarlsCourt-EastPutney"
    TsInserter.Insert(CSVName, TubeName, Date)

    # Backward #
    CSVName = "EastPutney-EarlsCourt"
    TsInserter.Insert(CSVName, TubeName, Date)

    ## EarlsCourt-EdgwareRoad Branch ##
    # Forward #
    CSVName = "EarlsCourt-EdgwareRoad"
    TsInserter.Insert(CSVName, TubeName, Date)

    # Backward #
    CSVName = "EdgwareRoad-EarlsCourt"
    TsInserter.Insert(CSVName, TubeName, Date)

    ## TurnhamGreen-WestHam Branch ##
    # Forward #
    CSVName = "TurnhamGreen-WestHam"
    TsInserter.Insert(CSVName, TubeName, Date)
    TsInserter.Insert(CSVName, TubeName, Date, 1)
    TsInserter.Insert(CSVName, TubeName, Date, 2)

    # Backward #
    CSVName = "WestHam-TurnhamGreen"
    TsInserter.Insert(CSVName, TubeName, Date)

    ## Kensington (Olympia) branch MISSING ##

    # Data #
    TempInserter.Insert(TubeName)
    PollInserter.Insert(TubeName)



    ### Insert Hammersmith & City ###
    TubeName = Consts.LINE_HAMMERSMITH_CITY
    Date = "21/01/2022"
    # Forward #
    CSVName = "Hammersmith-Whitechapel"
    TsInserter.Insert(CSVName, TubeName, Date)
    TsInserter.Insert(CSVName, TubeName, Date, 1)

    # Backward #
    CSVName = "Whitechapel-Hammersmith"
    TsInserter.Insert(CSVName, TubeName, Date)
    TsInserter.Insert(CSVName, TubeName, Date, 1)
    TsInserter.Insert(CSVName, TubeName, Date, 2)

    # Data #
    TempInserter.Insert(TubeName) # Only to Hammersmith?
    PollInserter.Insert(TubeName)



    ### Insert Jubilee ###
    TubeName = Consts.LINE_JUBILEE

    ## From Stratford to Baker Street ##
    Date = "26/01/2022"
    # Forward #
    CSVName = "Stratford-WillesdenGreen"
    TsInserter.Insert(CSVName, TubeName, Date)

    # Backward #
    CSVName = "WillesdenGreen-Stratford"
    TsInserter.Insert(CSVName, TubeName, Date)
    TsInserter.Insert(CSVName, TubeName, Date, 1)

    ## From Baker Street to Willesden Green ##
    Date = "04/02/2022"
    # Forward #
    CSVName = "Stratford-WillesdenGreen"
    TsInserter.Insert(CSVName, TubeName, Date, 1)

    # Backward #
    CSVName = "WillesdenGreen-Stratford"
    TsInserter.Insert(CSVName, TubeName, Date, 2)

    # Data #
    TempInserter.Insert(TubeName)
    PollInserter.Insert(TubeName)



    ### Insert Metropolitan ###
    # only contains timestamps between Baker Street/Finchley Road and Aldgate/Liverpool Street
    # Rest is contained within Hammersmith & City data
    TubeName = Consts.LINE_METROPOLITAN
    Date = "21/01/2022"
    # Forward #
    CSVName = "Aldgate-FinchleyRoad"
    TsInserter.Insert(CSVName, TubeName, Date)
    TsInserter.Insert(CSVName, TubeName, Date, 1)

    # Backward #
    CSVName = "FinchleyRoad-Aldgate"
    TsInserter.Insert(CSVName, TubeName, Date)
    TsInserter.Insert(CSVName, TubeName, Date, 1)
    # TsInserter.Insert(CSVName, TubeName, Date, 2)

    # Data #
    TempInserter.Insert(TubeName)
    PollInserter.Insert(TubeName) 


    ### Insert Northern ###
    TubeName = Consts.LINE_NORTHERN
    Date = "14/01/2022"

    # Bank Branch ##
    # Forward #
    CSVName = "Archway-ClaphamSouth"
    TsInserter.Insert(CSVName, TubeName, Date)
    TsInserter.Insert(CSVName, TubeName, Date, 1)

    # Backward #
    CSVName = "ClaphamSouth-Archway"
    TsInserter.Insert(CSVName, TubeName, Date)

    ## Charing Cross Branch Southern Part##
    Date = "27/01/2022"
    # Forward #
    CSVName = "Hampstead-BatterseaPowerStation"
    TsInserter.Insert(CSVName, TubeName, Date)

    # Backward #
    CSVName = "BatterseaPowerStation-Hampstead"
    TsInserter.Insert(CSVName, TubeName, Date)

    ## Charing Cross Branch Northern Part##
    Date = "17/01/2022"
    # Forward #
    CSVName = "Hampstead-BatterseaPowerStation"
    TsInserter.Insert(CSVName, TubeName, Date, 1)

    # Backward #
    CSVName = "BatterseaPowerStation-Hampstead"
    TsInserter.Insert(CSVName, TubeName, Date, 1)

    # Data #
    TempInserter.Insert(TubeName)
    PollInserter.Insert(TubeName)



    ### Insert Piccadilly ###
    TubeName = Consts.LINE_PICCADILLY
    Date = "27/01/2022"
    # Forward #
    CSVName = "Hammersmith-ManorHouse"
    TsInserter.Insert(CSVName, TubeName, Date)

    # Backward #
    CSVName = "ManorHouse-Hammersmith"
    TsInserter.Insert(CSVName, TubeName, Date)

    # Data #
    TempInserter.Insert(TubeName)
    PollInserter.Insert(TubeName)



    ### Insert Victoria ###
    TubeName = Consts.LINE_VICTORIA
    Date = "27/01/2022"
    # Forward #
    CSVName = "Brixton-FinsburyPark"
    TsInserter.Insert(CSVName, TubeName, Date)

    # Backward #
    CSVName = "FinsburyPark-Brixton"
    TsInserter.Insert(CSVName, TubeName, Date)
    TsInserter.Insert(CSVName, TubeName, Date, 1)

    # Data #
    TempInserter.Insert(TubeName)
    PollInserter.Insert(TubeName)


 
    ### Insert Waterloo & City ###
    TubeName = Consts.LINE_WATERLOO_CITY
    Date = "16/02/2022"
    # Forward #
    CSVName = "Bank-Waterloo"
    TsInserter.Insert(CSVName, TubeName, Date)

    # Backward #
    CSVName = "Waterloo-Bank"
    TsInserter.Insert(CSVName, TubeName, Date)
    
    # Data #
    TempInserter.Insert(TubeName)
    #PollInserter.Insert(TubeName) # Missing Data - Need to check device