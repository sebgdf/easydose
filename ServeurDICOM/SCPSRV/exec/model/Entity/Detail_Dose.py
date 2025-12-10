import sqlobject
from sqlobject import *

class DetailDose(sqlobject.SQLObject):
    _fromDatabase=True
    kvp=sqlobject.FloatCol()
    tempsExposition=sqlobject.FloatCol()
    xrayTubeContent=sqlobject.IntCol()   
    dose=sqlobject.ForeignKey('Dose')
    bodyPart=sqlobject.StringCol(length=255)
    valeur=sqlobject.FloatCol()
    body_part_easydose=sqlobject.StringCol(length=255)
    unite=sqlobject.StringCol(length=255)
    protocole=sqlobject.StringCol(length=255)
    machine=sqlobject.StringCol(length=255)
    date=sqlobject.DateTimeCol()
    modalite=sqlobject.StringCol(length=255)
    unitexrayTubeContent=sqlobject.StringCol(length=255)
    nrdhavealerte=sqlobject.TinyIntCol()
    sumhavealerte=sqlobject.TinyIntCol()
    nrdvaleur=sqlobject.FloatCol()
    uniteseuil=sqlobject.StringCol(length=255)