import sqlobject
from sqlobject import *

class Etablissement(sqlobject.SQLObject):
    _fromDatabase=True
    nom = sqlobject.StringCol(length=255)
    adresse = sqlobject.StringCol(length=255)
    addrlogo = sqlobject.StringCol(length=255)