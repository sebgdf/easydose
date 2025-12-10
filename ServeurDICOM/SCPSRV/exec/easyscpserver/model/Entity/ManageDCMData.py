'''
Created on 27 mars 2019

@author: sebastien
'''



'''from _mysql import NULL
'''
from sqlobject.mysql import builder
from sqlobject import dbconnection
from datetime import date, datetime
import pydicom
import traceback
from pydicom.dataset import Dataset
import pickle
from sqlobject import *

class ManageDCMData:

    ####
    # Constructeur de la classe
    # parametres:
    # dataset de type pydicom.dataset.FileDataset
    ####
    def __init__(self, dataset,_logging,_cfg):
        
        self.cfg=_cfg
        self.logging=_logging
        
        self.logging.warning('=========================================DEBUT ENREGISTREMENT INFORMATIONS FICHIER=============================')
        try:
            '''
            Enregistrement du dataset
            '''
            self.dose = dataset
            '''
            Enregistrement des informations du Patient
            '''
            self.logging.warning('Enregistrement des informations du Patient: ')
            if hasattr(self.dose,"PatientAge"):
                try:
                    self.patientage = self.dose.PatientAge
                except:
                    self.logging.error("Patient Age Error: %s",traceback.format_exc())
            self.sex="INDEFINI";
            try:
                self.dateexamen=datetime.strptime(self.dose.SeriesDate, "%Y%m%d")
            except:
                self.dateexamen=datetime.now()
            if self.dose.PatientSex=="M":
                self.sex="Homme";
            if self.dose.PatientSex=="F":
                self.sex="FEMME";
            if self.dose.PatientSex=="O":
                self.sex="INDEFINI";
            print(self.dose.PatientName)
            
            nomprenom=self.dose.PatientName
            self.patientname=" "
            self.patientprenom=" "
            if nomprenom and len(nomprenom)==2: 
                self.patientname= nomprenom[0]
                self.patientprenom = nomprenom[1]
            else:
                self.patientname= nomprenom.family_name
                self.patientprenom = nomprenom.given_name
                                    
           
           # if hasattr(self.dose,'OtherPatientNames'):
            #    self.patientprenom = self.dose.OtherPatientNames
            #else:
             #   self.patientprenom = " "
                
            self.patientnumipp = self.dose.PatientID
            self.patientdatedenaissance = datetime.strptime(self.dose.PatientBirthDate, "%Y%m%d")
            
            try:
                self.calculateAge(self.patientdatedenaissance)
            except ValueError:
                self.logging.error("Patient Age Error: %s",traceback.format_exc())
            self.unitageage=""
            if hasattr(self.dose,"PatientAge"):
                try:
                    self.dateexamen=datetime.strptime(self.dose.SeriesDate, "%Y%m%d")
                    self.unitageage="Y"     
                    if "Y" in self.dose.PatientAge:
                        self.patientage = self.dose.PatientAge.replace("Y","")
                        self.unitageage="Y"
                        
                    if "M" in self.dose.PatientAge:
                        self.patientage = self.dose.PatientAge.replace("M","")
                        self.unitageage="M"
                        
                    if "D" in self.dose.PatientAge:
                        self.patientage = self.dose.PatientAge.replace("D","")
                        self.unitageage="D"    
                    if "W" in self.dose.PatientAge:
                        self.patientage = self.dose.PatientAge.replace("W","")
                        self.unitageage="W"    
                except:
                    self.logging.error("Patient Age Error: %s",traceback.format_exc())             
            self.dosetotale = ""
            
    
            self.logging.warning("Recuperation modalite")
            for key in self.dose.dir():
                value = getattr(self.dose, key, '')
                if type(value) is pydicom.uid.UID or key == "PixelData":
                    continue
                if key == "Modality":
                    self.modalite = value        
            self.logging.warning("Modalite : %s", self.modalite)
    
        except ValueError:
           # self.logging.error("Erreur d'integration des doses pour patient: %s - type de fichier : %s",self.patientname,type)
            self.logging.error("Unexpected Error: %s",traceback.format_exc())
            
            
            
    def calculateAge(self,birthDate): 
        today = date.today() 
        self.patientage  = today.year - birthDate.year - ((today.month, today.day) < (birthDate.month, birthDate.day)) 

    '''
     Fontion insertinformation
    
    
    
    '''
    def insertInformation(self):
        '''
        Creation de la connection
        
        '''
        try:

            
            import configparser
            self.cfg = configparser.ConfigParser()
            self.cfg.read('/home/dicomserver/Config/easydose.cfg')
            sqlhub.processConnection = connectionForURI("mysql://root:Boss132@mysql:3307/easydose")
            self.logging.warning("Modalité: "+self.modalite)
            if hasattr(self,'modalite') and self.modalite == "MG":
                from MGManager import MGManager                
                mgmanager=MGManager(self,self.logging)
                self.logging.warning("############## Insert information ####################")
                mgmanager.insertInformation()  
                
            if hasattr(self,'modalite') and self.modalite == "SR":
                from SRManager import SRManager 
                srmanager=SRManager(self,self.logging)
                self.logging.warning("############## Insert information ####################")
                srmanager.insertInformation()
            if hasattr(self,'modalite') and self.modalite == "CR":
                from CRManager import CRManager 
                self.dosetotal=0
                try:
                    for element in self.dose:
                        if element.tag.elem== 6163:
                            self.dosetotal=element.value
                            break
                except:
                    self.logging.error("Unexpected Error: %s",traceback.format_exc())
                crmanager=CRManager(self,self.logging)
                self.logging.warning("############## Insert information ####################")
                crmanager.insertInformation()                            
            if hasattr(self,'modalite') and self.modalite != "MG" and self.modalite != "SR":
                self.logging.error('modalite non reconnue: %s', self.modalite)
                '''  from CTManager import CTManager 
                ctmanager=CTManager(self,self.logging)
                ctmanager.insertInformation()
                '''  
        except ValueError:
            type=""
            if hasattr(self,'modalite') and self.modalite:
                type=self.modalite
            #self.logging.error("Erreur d'integration des doses pour patient: %s - type de fichier : %s",self.patientname,type)
         
            self.logging.error("Erreur d'integration du fichier DICOM: %s",traceback.format_exc())
            erreurtrace=traceback.format_exc()
            sqlhub.processConnection = connectionForURI("mysql://root:Boss132@mysql:3307/easydose")
            from DICOMDbManager import DICOMDbManager
            dICOMDbManager=DICOMDbManager(self,self.logging)

           
            from Fichierdcm import Fichierdcm
            print("test")
            import random
            filenametmp= self.cfg.get('ERROR', 'direrror')+str(datetime.now())+str(random.randint(0,1000000))
            filename= filenametmp.replace(" ","_").replace(":","_").replace(".","_")+".dcm"
            print(filename)
            try:
                from pydicom.dataset import Dataset, FileDataset
                file_meta = Dataset()
                file_meta.MediaStorageSOPClassUID = '1.2.840.10008.5.1.4.1.1.2'
                file_meta.MediaStorageSOPInstanceUID = "1.2.3"
                file_meta.ImplementationClassUID = "1.2.3.4" 
                
                
                
                ds = FileDataset(filename, self.dose,
                 file_meta=file_meta, preamble=b"\0" * 128)

                ds.file_meta = file_meta
                ds.is_little_endian=True
                ds.is_implicit_VR=True
                ds.save_as(filename)
                '''pydicom.filewriter.write_file(filename, self.dose, write_like_original=True)
                '''
            except:
                self.logging.error("Erreur Enregistrement du fichir DICOM: %s",traceback.format_exc())
            myDCMFile = Fichierdcm(contenu=filename,date=date.today(),replay=0,replayed=0,result=1,traceback=erreurtrace)
            self.logging.warning("DCMFILE ID: %d ",myDCMFile.id)
            dICOMDbManager.insertmail("Erreur integration DICOM",traceback.format_exc(),"syserror",myDCMFile.id)
     
        self.logging.warning('=========================================FIN ENREGISTREMENT INFORMATIONS FICHIER=============================')
