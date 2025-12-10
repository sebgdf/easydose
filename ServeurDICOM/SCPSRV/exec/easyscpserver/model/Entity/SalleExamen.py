import sqlobject
from sqlobject import *

class SalleExamen(sqlobject.SQLObject):
    _fromDatabase=True
    nom=sqlobject.StringCol(length=255)

