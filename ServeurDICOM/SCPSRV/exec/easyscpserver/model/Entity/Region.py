import sqlobject
from sqlobject import *

class Region(sqlobject.SQLObject):
    _fromDatabase=True
    nom=sqlobject.StringCol(length=255)
    code=sqlobject.StringCol(length=255)
