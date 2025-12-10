'''
Created on 9 avr. 2019

@author: sebastien
'''
import sqlobject
from sqlobject import *
from Connector import Connector

class Mails(sqlobject.SQLObject):
    _fromDatabase=True
    obj = sqlobject.StringCol(length=255)
    msg = sqlobject.StringCol(length=512)
    type = sqlobject.StringCol(length=255)
    dicomfile = sqlobject.IntCol()
        