'''
Created on 10 mai 2019

@author: sebastien
'''

import sqlobject
from sqlobject import *

class Fichierdcm(sqlobject.SQLObject):
    _fromDatabase=True
    contenu = sqlobject.StringCol(length=1024)
    date=sqlobject.DateTimeCol()
    replay=sqlobject.TinyIntCol()
    replayed=sqlobject.TinyIntCol()
    result=sqlobject.IntCol()
    traceback= sqlobject.StringCol(length=1024)