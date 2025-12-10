'''
Created on 26 mars 2019

@author: sebastien
'''
from Dose import Dose
from Region import Region
from Patient import Patient
from Region_Dose import RegionDose
from Examen import Examen
from SalleExamen import SalleExamen
from Detail_Dose import DetailDose
from Connector import Connector   
from datetime import date, datetime
from Bodyparts import Bodyparts
from DICOMDbManager import DICOMDbManager
class MGManager(DICOMDbManager):
    '''
    classdocs
    '''


    def __init__(self, _manageDCMData,_loggin):
        '''
        Constructor
        '''
        super(MGManager, self).__init__(_manageDCMData,_loggin)
        
    def insertInformation(self):
        '''
        Methode d'insertion des informations provenant des fichiers DICOM de type MG
        
        '''
        self.loggin.warning('insertion des informations provenant des fichiers DICOM de type MG ')
        self._valeur=self.manageDCMData.dose.EntranceDoseInmGy
        
        myDose = Dose(unite='mGy',date=self.manageDCMData.dateexamen,protocole="INCONNU",valeur=float(self.manageDCMData.dose.EntranceDoseInmGy), modalite=self.manageDCMData.modalite, kvp=float(self.manageDCMData.dose.KVP), tempsExposition=float(self.manageDCMData.dose.ExposureTime), xrayTubeCurrent=int(self.manageDCMData.dose.XRayTubeCurrent))
        self.loggin.warning('Body part search :%s' , self.manageDCMData.dose.OrganExposed )
        
        bodyparts=Bodyparts.selectBy(dcmname=self.manageDCMData.dose.OrganExposed)
        cnt=Bodyparts.selectBy(dcmname=self.manageDCMData.dose.OrganExposed).count()
        
        if cnt == 0:
            raise('Error body Part unrenonized' )
        else:  
            DetailDose(uniteseuil=" ",nrdvaleur=0,sumhavealerte=0,nrdhavealerte=0,unitexrayTubeContent='mA',
                       modalite=self.manageDCMData.modalite,
                       date=self.manageDCMData.dateexamen,
                       machine=self.manageDCMData.dose.ManufacturerModelName,
                       unite='mGy',
                       protocole= self.manageDCMData.dose.ProtocolName.encode('utf-8'),
                       body_part_easydose=bodyparts[0].easydosename,
                       valeur=float(self.manageDCMData.dose.EntranceDoseInmGy),
                       kvp=float(self.manageDCMData.dose.KVP),
                       tempsExposition=float(self.manageDCMData.dose.ExposureTime), 
                       xrayTubeContent=int(self.manageDCMData.dose.XRayTubeCurrent), 
                       dose=myDose, 
                       bodyPart=self.manageDCMData.dose.OrganExposed)
            
 
        '''
        Recherche du Patient
        '''
        myPatient=self.managePatient()
        self.loggin.warning("Patient Enregistre")
        
        
        self.loggin.warning("Enregistrement Region")
        myRegion = Region(nom='test', code='testCode')
        self.loggin.warning("Region Enregistree")
        self.loggin.warning("Enregistrement Patient")
        
        RegionDose(dose=myDose, region=myRegion, date=date.today())

        self.loggin.warning("Enregistrement salle examen")
        mySalleEaxamen = SalleExamen(nom='Salle HA')
        self.loggin.warning("Salle examen Enregistree")
        self.loggin.warning("Enregistrement Detail Examen")
        Examen(date=date.today(), etablissement.nom, salleExamen=mySalleEaxamen, patient=myPatient, region=myRegion)
        self.loggin.warning("Detail Examen Enregistre")
        
        
        import requests 
        import configparser
        cfg = configparser.ConfigParser()  
        URL=cfg.get('POSTTRAITEMENT', 'urltraitement1') + str(myPatient.id)
        login=cfg.get('POSTTRAITEMENT', 'auth1') 
        password=cfg.get('POSTTRAITEMENT', 'passwd1') 
        if login!= "-1":
            resp=requests.get(url=URL,auth=(login,password))
            self.loggin.warning("Request result: %s",resp)
        else:
            resp=requests.get(url=URL)
            self.loggin.warning("Request result: %s",resp)