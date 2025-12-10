'''
Created on 4 avr. 2019

@author: sebastien
'''
import sqlobject
from sqlobject import *
from Connector import Connector



class Bodyparts(sqlobject.SQLObject):
    '''
    classdocs
    '''
    _fromDatabase=True
    dcmname=sqlobject.StringCol(length=255)
    easydosename=sqlobject.StringCol(length=255)