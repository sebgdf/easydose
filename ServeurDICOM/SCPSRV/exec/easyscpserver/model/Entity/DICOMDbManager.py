'''
Created on 27 mars 2019

@author: sebastien
'''

from Connector import Connector   
from datetime import date, datetime

from mysql.connector.dbapi import Date
from sqlobject.sqlbuilder import Update
from sqlobject.sqlbuilder import AND
from sqlobject.mysql import builder
from sqlobject import *
import configparser

class DICOMDbManager(object):
    '''
    classdocs
    '''


    def __init__(self, _manageDCMData,_loggin):
        '''
        Constructor
        '''
        self.loggin=_loggin
        self.manageDCMData=_manageDCMData
        self.cfg = configparser.ConfigParser()
        self.cfg.read('/home/dicomserver/Config/easydose.cfg')
        self.type=""
    
    def managePatient(self):
        sqlhub.processConnection = connectionForURI("mysql://root:Boss132@mysql:3307/easydose")
     
        from Patient import Patient 
        self.loggin.warning('Patient %s Existe? ',self.manageDCMData.patientname)

        if hasattr(self.manageDCMData,"PatientBirthDate") and self.manageDCMData.PatientBirthDate != None:
            PatientOlds=Patient.selectBy(datenaissance=self.manageDCMData.PatientBirthDate ,nom=self.manageDCMData.patientname.encode('utf-8').decode('utf-8'),prenom=self.manageDCMData.patientprenom.encode('utf-8').decode('utf-8'))
        else:
            PatientOlds=Patient.selectBy(nom=self.manageDCMData.patientname.encode('utf-8').decode('utf-8'),prenom=self.manageDCMData.patientprenom.encode('utf-8').decode('utf-8'))
        #PatientOlds. =sqlhub.processConnection
        patientpresent=False;
        for PatientTmp in PatientOlds:
            if PatientTmp.numipp==self.manageDCMData.patientnumipp :
                patientpresent=True;
                PatientOld=PatientTmp;
                
        if patientpresent and PatientOld:
            myPatient=PatientOld; # on est sur le bon patient
            self.loggin.warning('Patient trouve !!!')
        else: 
            self.loggin.warning('Nouveau Patient => insertion')                  
            myPatient = Patient(havenotes=0,nbdoses=0,sumhavealerte=0,nrdhavealerte=0,idregional="_",sex=self.manageDCMData.sex,uniteage=self.manageDCMData.unitageage,prenom=self.manageDCMData.patientprenom.encode('utf-8').decode('utf-8'), nom=self.manageDCMData.patientname.encode('utf-8').decode('utf-8'), numipp=self.manageDCMData.patientnumipp, datenaissance=self.manageDCMData.patientdatedenaissance, age=int(self.manageDCMData.patientage))
            patientid=myPatient.id
            id_regional='ED_'+format(patientid,'09')
            myPatient.idregional=id_regional
        if self.type == "MG":
            myPatient.havemammo=1

        self.loggin.warning("Patient Enregistre")
        return myPatient
    
    def insertmail(self,_object,message,tpe,fileid): 
        sqlhub.processConnection = connectionForURI("mysql://root:Boss132@mysql:3307/easydose")
        from Mails import Mails     
        mail=Mails(dicomfile=fileid,obj=_object,msg=message[0:1024],type=tpe)
     
    
