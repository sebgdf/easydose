import sqlobject
from sqlobject import *

class Parametre(sqlobject.SQLObject):
    _fromDatabase=True
    nom = sqlobject.StringCol(length=255)
    valeur = sqlobject.StringCol(length=255)
