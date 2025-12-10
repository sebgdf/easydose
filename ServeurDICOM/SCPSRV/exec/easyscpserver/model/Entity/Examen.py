import sqlobject
from sqlobject import *
from Connector import Connector

class Examen(sqlobject.SQLObject):
    _fromDatabase=True
    date = sqlobject.DateTimeCol()
    nomCabinet = sqlobject.StringCol(length=255)
    salleExamen = sqlobject.ForeignKey('SalleExamen')
    patient = sqlobject.ForeignKey('Patient')
    region = sqlobject.ForeignKey('Region')
    #studydate = sqlobject.DateTimeCol()
    #studytime = sqlobject.TinyIntCol()
    #studydescription = sqlobject.StringCol(length=255)
    #seriesdescription = sqlobject.StringCol(length=255)
    #manufacturer = sqlobject.StringCol(length=255)
    #manufacturermodelname = sqlobject.StringCol(length=255)
