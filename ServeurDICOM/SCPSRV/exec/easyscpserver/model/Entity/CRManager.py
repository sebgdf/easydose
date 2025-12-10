'''
Created on 26 mars 2019

@author: sebastien
'''
from Connector import Connector   
from datetime import date, datetime
from DICOMDbManager import DICOMDbManager
import pydicom
from sqlobject.mysql import builder
from sqlobject import *
import configparser
#from xmlrpclib import ProtocolError

class CRManager(DICOMDbManager):
    '''
    classdocs
    '''


    def __init__(self, _manageDCMData,_loggin):
        '''
        Constructor
        '''
        super(CRManager, self).__init__(_manageDCMData,_loggin)
        self.type="CR"
    
    def insertInformation(self):
        '''
        Methode d insertion des infomration provenant des fichiers DICOM de type CR
        '''
        self.loggin.warning("Traitement type : %s", self.manageDCMData.modalite)
        self.loggin.warning("Recuperation dose totale :")
        _val=0
        _unite=""
        try:
           _val=float(self.manageDCMData.dosetotal.split(" ")[0])
           _unite=self.manageDCMData.dosetotal.split(" ")[1]
        except:
             self.loggin.error("Erreur recuperation valeur dose")
        manufacturermodelname=""
        manufacturer=""
        StudyDescription=""
        SeriesDescription=""
        StudyTime=0
        RadiationSetting=""
        RadiationMode=""
        ImageandFluoroscopyAreaDoseProductKeep=0.0
        XRayTubeCurrentinµA=0
        for key in self.manageDCMData.dose.dir():
                value = getattr(self.manageDCMData.dose, key, '')
                if type(value) is pydicom.uid.UID or key == "PixelData":
                    continue
                if key == "ManufacturerModelName":
                     manufacturermodelname= value   
                if key == "Manufacturer":
                     manufacturer= value  
                if key == "StudyDescription":
                     StudyDescription= value
                if key == "SeriesDescription":
                     SeriesDescription= value 
                if key == "StudyTime":
                     StudyTime= value 
                if key == "RadiationSetting":
                     RadiationSetting= value 
                if key == "RadiationMode":
                     RadiationMode= value
                if key == "ImageAndFluoroscopyAreaDoseProduct":
                     ImageandFluoroscopyAreaDoseProductKeep= value
                if key == "XRayTubeCurrentInuA":
                     XRayTubeCurrentinµA= value
       
        from Dose import Dose
        myDose = Dose(date=self.manageDCMData.dateexamen,protocole=self.manageDCMData.dose.Modality,valeur=float(self.manageDCMData.dosetotal.split(" ")[0]),unite=self.manageDCMData.dosetotal.split(" ")[1], modalite=self.manageDCMData.modalite, kvp=float(self.manageDCMData.dose.KVP), tempsExposition=float(self.manageDCMData.dose.ExposureTime), xrayTubeCurrent=10)
        easydosebodyparts="UNKNOW"
        
        from Detail_Dose import DetailDose
        DetailDose(body_part_easydose=easydosebodyparts,
                   kvp=float(self.manageDCMData.dose.KVP), 
                   tempsExposition=float(self.manageDCMData.dose.ExposureTime),
                   xrayTubeContent=int(self.manageDCMData.dose.XRayTubeCurrent), 
                   dose=myDose, 
                   bodyPart=easydosebodyparts,
                   valeur=_val,
                   unite=_unite,
                   protocole=self.manageDCMData.dose.Modality,
                   machine=manufacturermodelname,
                   date=self.manageDCMData.dateexamen,
                   modalite=self.manageDCMData.dose.Modality,
                   unitexrayTubeContent="",
#                   xrayTubeContentinua=XRayTubeCurrentinµA,
                   nrdhavealerte=0,
                   sumhavealerte=0,
                   nrdvaleur=0.0,
                   uniteseuil="")
#                   imageandfluoroscopyareadoseproduct=float(ImageandFluoroscopyAreaDoseProductKeep),
#                   manufacturer=manufacturer,
#                   manufacturermodelname=manufacturermodelname,
#                   radiationmode=RadiationMode,
#                   radiationsetting=RadiationSetting
                  
        self.loggin.warning("Enregistrement Region")
        from Region import Region        
        myRegion = Region(nom='test', code='testCode')
        self.loggin.warning("Region Enregistree")
        self.loggin.warning("Enregistrement Patient")
            #verifions que le patient n existe pas 
        from Etablissement import Etablissement 
        etablissement=Etablissement.selectBy()[0]
            
        myPatient=self.managePatient()  
        myPatient.datelastexam=date.today()     
        self.loggin.warning("Patient Enregistre")
        from Region_Dose import RegionDose 
        RegionDose(dose=myDose, region=myRegion, date=date.today())
        
        self.loggin.warning("Enregistrement salle examen")
        from SalleExamen import SalleExamen 
        mySalleEaxamen = SalleExamen(nom=etablissement.nom)
        self.loggin.warning("Salle examen Enregistree")
        self.loggin.warning("Enregistrement Detail Examen")
        from Examen import Examen 
        Examen(date=date.today(), nomCabinet=etablissement.nom, salleExamen=mySalleEaxamen, patient=myPatient, region=myRegion)#,studydate = self.manageDCMData.dateexamen,studytime = int(StudyTime),studydescription = StudyDescription,seriesdescription = SeriesDescription,manufacturer = manufacturer, manufacturermodelname = manufacturermodelname)
        self.loggin.warning("Detail Examen Enregistre") 
        
        
    