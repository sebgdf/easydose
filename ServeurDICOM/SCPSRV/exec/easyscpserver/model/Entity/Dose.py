import sqlobject
from sqlobject import *
from Connector import Connector


class Dose(sqlobject.SQLObject):
    _fromDatabase=True
    modalite = sqlobject.StringCol(length=255)
    valeur = sqlobject.FloatCol()
    kvp = sqlobject.FloatCol()
    tempsExposition = sqlobject.FloatCol()
    xrayTubeCurrent = sqlobject.IntCol()
    date=sqlobject.DateTimeCol()
    protocole=sqlobject.StringCol(length=255)
    unite=sqlobject.StringCol(length=255)
