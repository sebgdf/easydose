import sqlobject
from sqlobject import *
class Patient(sqlobject.SQLObject):
    _fromDatabase=True
    nom=sqlobject.StringCol(length=255)
    prenom=sqlobject.StringCol(length=255)
    sex=sqlobject.StringCol(length=255)
    numipp=sqlobject.StringCol(length=255)
    datenaissance=sqlobject.DateTimeCol()
    age=sqlobject.IntCol()
    uniteage=sqlobject.StringCol(length=255)
    idregional=sqlobject.StringCol(length=255)
    nrdhavealerte=sqlobject.TinyIntCol()
    sumhavealerte=sqlobject.TinyIntCol()
    nbdoses=sqlobject.IntCol()
    havenotes=sqlobject.TinyIntCol()
    havemammo=sqlobject.TinyIntCol()
    haveradio=sqlobject.TinyIntCol()
    havescanner=sqlobject.TinyIntCol()
    datelastexam=sqlobject.DateTimeCol()