'''
Created on 26 mars 2019

@author: sebastien
'''

from DICOMDbManager import DICOMDbManager

from sqlobject.mysql import builder
import configparser

class CTManager(DICOMDbManager):
    '''
    classdocs
    '''


    def __init__(self, _manageDCMData,_loggin):
        '''
        Constructor
        '''
        super(CTManager, self).__init__(_manageDCMData,_loggin)
        self.type="CT"
    def insertInformation(self):
        '''
        Methode d insertion des infomration provenant des fichiers DICOM de type CT
        
        '''
        self.loggin.warning("Traitement type : %s", self.manageDCMData.modalite)
        self.loggin.warning("Recuperation dose totale :")
        
        
        if hasattr(self.manageDCMData.dose,'CommentsOnRadiationDose') and self.manageDCMData.dose.CommentsOnRadiationDose:
            try:
                totaldlpsequence = self.manageDCMData.dose.CommentsOnRadiationDose.split("\r")[0]
            except:
                raise Exception("erreur recuperation valeur DOSE fichier CT : raison 03")
            if totaldlpsequence :
                self.manageDCMData.dosetotal = totaldlpsequence.split("=")[1]                 
                self.loggin.warning("dose totale : %s", self.manageDCMData.dosetotal)
            else:
                raise Exception("erreur recuperation valeur DOSE fichier CT : raison 01")
                # Enregistrement en base de donnees des informations
        else:
            raise Exception("erreur recuperation valeur DOSE fichier CT : raison 02")
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
        
        myDose = Dose(date=self.manageDCMData.dateexamen,protocole="INCONNU",valeur=float(self.manageDCMData.dosetotal), modalite=self.manageDCMData.modalite, kvp=0, tempsExposition=10, xrayTubeCurrent=10)

        for sequence in self.manageDCMData.dose.ExposureDoseSequence :
            self.loggin.warning('Body part search :%s' , sequence.BodyPartExamined )
            bodyparts=Bodyparts.selectBy(dcmname=sequence.BodyPartExamined)
            easydosebodyparts="UNKNOW"
            cnt=Bodyparts.selectBy(dcmname=sequence.BodyPartExamined).count()
            if cnt > 0:
                easydosebodyparts=bodyparts[0].easydosename
            
              
            DetailDose(body_part_easydose=easydosebodyparts,kvp=float(sequence.KVP), tempsExposition=float(sequence.ExposureTime), xrayTubeContent=int(sequence.XRayTubeCurrentInuA), dose=myDose, bodyPart=sequence.BodyPartExamined,valeur=0)
        
        self.loggin.warning("Enregistrement Region")

        myRegion = Region(nom='test', code='testCode')
        self.loggin.warning("Region Enregistree")
        self.loggin.warning("Enregistrement Patient")
            #verifions que le patient n existe pas 
            
        myPatient=self.managePatient()
        
        self.loggin.warning("Patient Enregistre")

        RegionDose(dose=myDose, region=myRegion, date=date.today())

        self.loggin.warning("Enregistrement salle examen")

        mySalleEaxamen = SalleExamen(nom='Salle HA')
        self.loggin.warning("Salle examen Enregistree")
        self.loggin.warning("Enregistrement Detail Examen")
        from Etablissement import Etablissement 
        etablissement=Etablissement.selectBy()[0]
        Examen(date=date.today(), nomCabinet=etablissement.nom, salleExamen=mySalleEaxamen, patient=myPatient, region=myRegion)
        self.loggin.warning("Detail Examen Enregistre")          