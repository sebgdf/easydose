'''
Created on 16 mai 2019

@author: sebastien
'''

import sys
from datetime import datetime
from pydicom.dataset import Dataset

sys.path.append("Entity")


import configparser
import logging
import pydicom
import traceback
from sqlobject.mysql import builder
from ManageDCMData import ManageDCMData
from sqlobject import *
class Replay(object):
    
    def __init__(self):
        '''
        Constructor
 
        '''
        self.cfg = configparser.ConfigParser()
        self.cfg.read('Config/easydose.cfg')
        logging.basicConfig(filename=self.cfg.get('LOG', 'fileName'), level=logging.DEBUG, format='%(asctime)s %(message)s')
        logging.warning('Initialisation classe: %s', 'Replay')
        
        self.logging=logging    
                
    def replay(self):
        try:
            sqlhub.processConnection = connectionForURI("mysql://root:Boss132@mysql:3307/easydose")
            from Fichierdcm import Fichierdcm
            
            self.logging.warning('Search DCM by replay')
            listefichiersdcm=Fichierdcm.selectBy(replay= 1,replayed=0);
            for fichierdcm in listefichiersdcm: 
                try:
                    self.logging.warning('Replay fichier DCM id N: %d', fichierdcm.id);
                    dose= pydicom.dcmread(fichierdcm.contenu);
                    manageDCMData = ManageDCMData(dose,self.logging,self.cfg);
                    manageDCMData.insertInformation();
                    fichierdcm.replay=0;
                    fichierdcm.replayed=1;
                    fichierdcm.result=0;
                    fichierdcm.traceback="Insertion ok"
                except:
                    self.logging.error("Erreur traitement fichier DCM id: %d : %s",fichierdcm.id,traceback.format_exc());
                    fichierdcm.replay=0;
                    fichierdcm.replayed=1;
                    fichierdcm.result=1;
                    fichierdcm.traceback=traceback.format_exc()[0:1024];
        except:
                self.logging.error("Unexpected Error: %s",traceback.format_exc())