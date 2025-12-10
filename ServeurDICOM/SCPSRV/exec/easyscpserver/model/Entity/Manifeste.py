import sqlobject
from sqlobject import *
from Connector import Connector
class Manifeste(sqlobject.SQLObject):
    _fromDatabase=True
    etablissement=sqlobject.StringCol(length=255)
    ippetablissementpatient=sqlobject.StringCol(length=255)
    datetransmission=sqlobject.DateTimeCol()
    transmissionok=sqlobject.TinyIntCol()
    numtransaction=sqlobject.StringCol(length=255)
    status=sqlobject.StringCol(length=255)
    idexamensource=sqlobject.IntCol()
    idexamencible=sqlobject.IntCol()
    idpatientsource=sqlobject.IntCol()
    idpatientcible=sqlobject.IntCol()