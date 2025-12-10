import sqlobject
from sqlobject import *

class RegionDose(sqlobject.SQLObject):
    _fromDatabase=True
    date=sqlobject.DateTimeCol()
    dose=sqlobject.ForeignKey('Dose')
    region=sqlobject.ForeignKey('Region')
