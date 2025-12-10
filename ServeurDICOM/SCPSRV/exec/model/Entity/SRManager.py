'''
Created on 26 mars 2019

@author: sebastien
'''

from DICOMDbManager import DICOMDbManager
#from xmlrpclib import ProtocolError

class SRManager(DICOMDbManager):
    '''
    classdocs
    '''


    def __init__(self, _manageDCMData,_loggin):
        '''
        Constructor
        '''
        super(SRManager, self).__init__(_manageDCMData,_loggin)
    
    
    def getDICOMAttribute(self,content,attributename,isnumericvalue):
        _val= None
        if isnumericvalue:
            test=False                            
            if hasattr(content,'ConceptNameCodeSequence'):
                for content21 in content.ConceptNameCodeSequence:
                    if content21.CodeMeaning == attributename:                                        
                        test=True
            if hasattr(content,'MeasuredValueSequence') and test:
                for content2 in content.MeasuredValueSequence:
                    if hasattr(content2,'NumericValue'):                        
                        _val= content2.NumericValue
                        
        else:
            test=False;
            if hasattr(content,'ConceptNameCodeSequence'):
                for content2 in content.ConceptNameCodeSequence:
                    if content2.CodeMeaning == attributename:                                        
                        test=True                                        
                    if hasattr(content2,'ConceptCodeSequence') and test:
                        for content3 in content2.ConceptCodeSequence:
                            if hasattr(content3,'CodeMeaning'):
                                _val= content3.CodeMeaning 
        return _val
    
    
    def getDICOMAttribute2(self,content,attributename,isnumericvalue):
        _val= None
        if isnumericvalue:
            test=False                            
            if hasattr(content,'ContentSequence'): 
                for content4 in content.ContentSequence:
                    tmp = self.getDICOMAttribute2(content4,attributename,isnumericvalue)
                    if tmp:
                        _val=tmp
            
            if hasattr(content,'ConceptNameCodeSequence'):
                for concept in content.ConceptNameCodeSequence:
                    if concept.CodeMeaning == attributename:
                        test=True
                                                              
       
            if hasattr(content,'MeasuredValueSequence') and test:
                for content2 in content.MeasuredValueSequence:
                    if hasattr(content2,'NumericValue'):                        
                        _val= content2.NumericValue
                        
                        
        else:
            test=False                            
            if hasattr(content,'ContentSequence'): 
                for content4 in content.ContentSequence:
                    tmp=self.getDICOMAttribute2(content4,attributename,isnumericvalue)
                    if tmp:
                        _val=tmp 
            if hasattr(content,'ConceptNameCodeSequence'):
                for concept in content.ConceptNameCodeSequence:
                    if concept.CodeMeaning == attributename:
                        test=True         
        
            if hasattr(content,'ConceptCodeSequence') and test:
                for concept in content.ConceptCodeSequence:
                    if hasattr(concept,'CodeMeaning'):
                        _val= concept.CodeMeaning
                       
        
        return _val
    
    def getProcedureReported(self,content):
        _val= None
        test=False
        tmp=None
        
        if hasattr(content,'ConceptNameCodeSequence'):             
            for conceptName in content.ConceptNameCodeSequence:
                if hasattr(conceptName,'CodeMeaning'):                                     
                    if conceptName.CodeMeaning=="Procedure reported":                        
                        tmp= self.getprocedurename(content)
                        if tmp:
                            _val=tmp 
        
        if hasattr(content,'ContentSequence'): 
            for content4 in content.ContentSequence:                
                tmp= self.getProcedureReported(content4)
                if tmp:
                    _val=tmp
        return _val
    
    
    def getprocedurename(self,content):
        _val=None                                     
        if hasattr(content,'ConceptCodeSequence') :
            for conceptCode in content.ConceptCodeSequence:
                if hasattr(conceptCode,'CodeMeaning'):                                    
                    _val = conceptCode.CodeMeaning
        return _val    
    
        
    def getDICOMAttributeWithFunc(self,content,attributenameGlobal,attributename,func):
        _val= None
        test=False
        tmp=None
        
        if hasattr(content,'ConceptNameCodeSequence'):             
            for conceptName in content.ConceptNameCodeSequence:
                if hasattr(conceptName,'CodeMeaning'):                                     
                    if conceptName.CodeMeaning==attributenameGlobal:                        
                        tmp= func(content,attributename)
                        if tmp:
                            _val=tmp 
                            
                            
        
        if hasattr(content,'ContentSequence'): 
            for content4 in content.ContentSequence:                
                tmp= self.getDICOMAttributeWithFunc(content4,attributenameGlobal,attributename,func)
                if tmp:
                    _val=tmp
        return _val
    
    def getTotalProduct(self,content,attributename): 
        _val=None
        tmp=None
        test=False          
        if hasattr(content,'ContentSequence'): 
            for content4 in content.ContentSequence:                
                tmp= self.getTotalProduct(content4,attributename)
                if tmp:
                    _val=tmp
        if hasattr(content,'ConceptNameCodeSequence'):
            
            for concept in content.ConceptNameCodeSequence:                
                if concept.CodeMeaning == attributename:
                    test=True
                    
            if hasattr(content,'MeasuredValueSequence') and test:
                for mesuredvalue in content.MeasuredValueSequence:
                    if hasattr(mesuredvalue,'NumericValue'):                                    
                        _val = mesuredvalue.NumericValue 
        return _val
    

    def getTotalProduct4(self,content,attributename): 
        _val=None
        tmp=None
        test=False          
        if hasattr(content,'ContentSequence'): 
            for content4 in content.ContentSequence:                
                tmp= self.getTotalProduct4(content4,attributename)
                if tmp:
                    _val=tmp
        if hasattr(content,'ConceptNameCodeSequence'):
            
            for concept in content.ConceptNameCodeSequence:                
                if concept.CodeMeaning == attributename:
                    test=True
                    
            if hasattr(content,'MeasuredValueSequence') and test:
                for mesuredvalue in content.MeasuredValueSequence:
                    if hasattr(mesuredvalue,'MeasurementUnitsCodeSequence'):
                       for measurementunit in mesuredvalue.MeasurementUnitsCodeSequence: 
                           if hasattr(measurementunit,'CodeMeaning'):                                    
                               _val = measurementunit.CodeMeaning 
        return _val
    

    def getTotalProduct2(self,content,attributename): 
        _val=None
        tmp=None
        test=False
         
        if hasattr(content,'ContentSequence'): 
            for content4 in content.ContentSequence:                
                tmp= self.getTotalProduct2(content4,attributename)
                if tmp:
                    _val=tmp
        if hasattr(content,'ConceptNameCodeSequence'):                   
            for concept in content.ConceptNameCodeSequence:                                
                if concept.CodeMeaning == attributename:
                    test=True                                       
            if hasattr(content,'ConceptCodeSequence') and test:
                for conceptCode in content.ConceptCodeSequence:
                    if hasattr(conceptCode,'CodeMeaning'):                                    
                        _val = conceptCode.CodeMeaning
        return _val    

    def getTotalProduct3(self,content,attributename): 
        _val=None
        tmp=None
        test=False          
        if hasattr(content,'ContentSequence'): 
            for content4 in content.ContentSequence:                
                tmp= self.getTotalProduct3(content4,attributename)
                if tmp:
                    _val=tmp
        if hasattr(content,'ConceptNameCodeSequence'):
          
            for concept in content.ConceptNameCodeSequence:                
                if concept.CodeMeaning == attributename:
                    test=True
                    
            if hasattr(content,'TextValue') and test:
                _val = content.TextValue
             
        return _val
    
    def createDose(self,content):
        return Dose(valeur=float(content.NumericValue), modalite=self.manageDCMData.modalite, kvp=0, tempsExposition=10, xrayTubeCurrent=10)
                         
        
    
    def insertInformation(self):
        '''
        Methode d insertion des information provenant des fichiers DICOM de type SR
        '''
        if self.manageDCMData.dose.ContentSequence:  
            self._region=""
            self._valeur=0
            self._tempsexposition=""
            self._kvp=""
            self._xraytubecourrant=0 
            unitetotale=""
            protocole=""
            protocoleall=""
            nbacquisition=0
            procedureName=self.getProcedureReported(self.manageDCMData.dose)
            print procedureName
            if procedureName =="Projection X-Ray":
                dosetotale=self.getDICOMAttributeWithFunc(self.manageDCMData.dose,"Accumulated X-Ray Dose Data","Dose Area Product Total",self.getTotalProduct)          
                unitetotale=self.getDICOMAttributeWithFunc(self.manageDCMData.dose,"Accumulated X-Ray Dose Data","Dose Area Product Total",self.getTotalProduct4) 
            if procedureName =="Computed Tomography X-Ray":
                dosetotale=self.getDICOMAttributeWithFunc(self.manageDCMData.dose,"CT Accumulated Dose Data","CT Dose Length Product Total",self.getTotalProduct)          
                unitetotale=self.getDICOMAttributeWithFunc(self.manageDCMData.dose,"CT Accumulated Dose Data","CT Dose Length Product Total",self.getTotalProduct4) 
                #protocole=self.getDICOMAttributeWithFunc(self.manageDCMData.dose,"CT Acquisition","Acquisition Protocol",self.getTotalProduct3)
            print dosetotale
            print unitetotale
         
            from Dose import Dose
            from Region import Region
            from Patient import Patient
            from Region_Dose import RegionDose
            from Examen import Examen
            from SalleExamen import SalleExamen
            from Detail_Dose import DetailDose 
            from datetime import date, datetime
            from Bodyparts import Bodyparts
           
            myDose=Dose(unite=unitetotale,date=self.manageDCMData.dateexamen,protocole="INCONNU",valeur=float(dosetotale), modalite=self.manageDCMData.modalite, kvp=0, tempsExposition=10, xrayTubeCurrent=10)  
            if procedureName =="Projection X-Ray":
                if hasattr(self.manageDCMData.dose,'ContentSequence'): 
                    for content in self.manageDCMData.dose.ContentSequence:                                                                               
                        if hasattr(content,'ConceptNameCodeSequence'): 
                            self._valeur=self.getDICOMAttributeWithFunc(content,"Irradiation Event X-Ray Data","Dose Area Product",self.getTotalProduct) 
                            physicallocation=self.getDICOMAttributeWithFunc(content,"Device Observer Physical Location During Observation","Device Observer Physical Location During Observation",self.getTotalProduct3)                                
                            _unite=self.getDICOMAttributeWithFunc(content,"Irradiation Event X-Ray Data","Dose Area Product",self.getTotalProduct4)                
                            _protocole=self.getDICOMAttributeWithFunc(self.manageDCMData.dose,"Irradiation Event X-Ray Data","Acquisition Protocol",self.getTotalProduct3)
                            _machine=self.getDICOMAttributeWithFunc(self.manageDCMData.dose,"Device Observer Model Name","Device Observer Model Name",self.getTotalProduct3)
                 #          
                 #           
                            self._region=self.getDICOMAttributeWithFunc(content,"Irradiation Event X-Ray Data","Target Region",self.getTotalProduct2) 
                            self._tempsexposition=self.getDICOMAttributeWithFunc(content,"Irradiation Event X-Ray Data","Exposure Time",self.getTotalProduct) 
                            self._kvp=self.getDICOMAttributeWithFunc(content,"Irradiation Event X-Ray Data","KVP",self.getTotalProduct) 
                            self._xraytubecourrant=self.getDICOMAttributeWithFunc(content,"Irradiation Event X-Ray Data","X-Ray Tube Current",self.getTotalProduct) 
                            _xraytubecourrantuynite=self.getDICOMAttributeWithFunc(content,"Irradiation Event X-Ray Data","X-Ray Tube Current",self.getTotalProduct4) 
                            if _machine and self._valeur and self._region and self._tempsexposition and self._kvp and self._xraytubecourrant:                            
                                self.loggin.warning('Body part search :%s' , self._region )
                                bodyparts=Bodyparts.selectBy(dcmname=self._region)
                                cnt=Bodyparts.selectBy(dcmname=self._region).count()
                                if  cnt == 0:
                                    raise(Exception('Error body Part unrenonized') )
                                else:    
                                    if _protocole not in protocoleall:
                                        if protocoleall != "":
                                            protocoleall=   "%s - %s" %(protocoleall,_protocole)
                                        else:
                                            protocoleall=   _protocole                         
                                    DetailDose(uniteseuil=" ",nrdvaleur=0,sumhavealerte=0,nrdhavealerte=0,unitexrayTubeContent=_xraytubecourrantuynite,modalite=self.manageDCMData.modalite,date=self.manageDCMData.dateexamen,machine=_machine,protocole=_protocole.encode('utf-8'),unite=_unite,body_part_easydose=bodyparts[0].easydosename,valeur=float(self._valeur),kvp=float(self._kvp), tempsExposition=float(self._tempsexposition), xrayTubeContent=int(self._xraytubecourrant), dose=myDose, bodyPart=self._region)
            
            
            if procedureName =="Computed Tomography X-Ray":
                if hasattr(self.manageDCMData.dose,'ContentSequence'): 
                    for content in self.manageDCMData.dose.ContentSequence:                                                                               
                        if hasattr(content,'ConceptNameCodeSequence'): 
                            self._valeur=self.getDICOMAttributeWithFunc(content,"CT Acquisition","DLP",self.getTotalProduct) 
                           
                            _machine=self.getDICOMAttributeWithFunc(self.manageDCMData.dose,"Device Observer Model Name","Device Observer Model Name",self.getTotalProduct3)
                 #           physicallocation=self.getDICOMAttributeWithFunc(content,"Device Observer Physical Location During Observation","Device Observer Physical Location During Observation",self.getTotalProduct3)                                
                            _unite=self.getDICOMAttributeWithFunc(content,"CT Acquisition","DLP",self.getTotalProduct4)                
                            type=self.getDICOMAttributeWithFunc(content,"CT Acquisition","CT Acquisition Type",self.getTotalProduct2) 
                            _protocole=self.getDICOMAttributeWithFunc(self.manageDCMData.dose,"CT Acquisition","Acquisition Protocol",self.getTotalProduct3)
                            
                            self._region=self.getDICOMAttributeWithFunc(content,"CT Acquisition","Target Region",self.getTotalProduct2) 
                            self._tempsexposition=self.getDICOMAttributeWithFunc(content,"CT Acquisition","Exposure Time",self.getTotalProduct) 
                            self._kvp=self.getDICOMAttributeWithFunc(content,"CT Acquisition","KVP",self.getTotalProduct) 
                            self._xraytubecourrant=self.getDICOMAttributeWithFunc(content,"CT Acquisition","X-Ray Tube Current",self.getTotalProduct) 
                            _xraytubecourrantuynite=self.getDICOMAttributeWithFunc(content,"CT Acquisition","X-Ray Tube Current",self.getTotalProduct4)
                            print "self._valeur:"
                            print self._valeur
                            print "unite:"
                            print _unite
                            print "protocole:"
                            print _protocole
                            print "self._region:"
                            print self._region
                            print "self._tempsexposition:"
                            print self._tempsexposition
                            print "self._kvp:"
                            print self._kvp
                            print "self._xraytubecourrant:"
                            print self._xraytubecourrant
                            
                            if _machine and self._valeur and self._region and self._tempsexposition and self._kvp and self._xraytubecourrant and _protocole and _unite:                            
                                self.loggin.warning('Body part search :%s' , self._region )
                                bodyparts=Bodyparts.selectBy(dcmname=self._region)
                                cnt=Bodyparts.selectBy(dcmname=self._region).count()
                                if  cnt == 0:
                                    raise('Error body Part unrenonized' )
                                else:
                                    if _protocole not in protocoleall:
                                        if protocoleall != "":
                                            protocoleall =   "%s - %s" %(protocoleall,_protocole)
                                        else:
                                            protocoleall =   _protocole                         
                                    DetailDose(uniteseuil=" ",nrdvaleur=0,sumhavealerte=0,nrdhavealerte=0,unitexrayTubeContent=_xraytubecourrantuynite,modalite=self.manageDCMData.modalite,date=self.manageDCMData.dateexamen,machine=_machine,unite=_unite,protocole=_protocole.encode('utf-8'),body_part_easydose=bodyparts[0].easydosename,valeur=float(self._valeur),kvp=float(self._kvp), tempsExposition=float(self._tempsexposition), xrayTubeContent=int(self._xraytubecourrant), dose=myDose, bodyPart=self._region)
            myDose.protocole=protocoleall.encode('utf-8')
                 
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
            from Etablissement import Etablissement 
            etablissement=Etablissement.selectBy()[0]
            Examen(date=date.today(), nomCabinet=etablissement.nom, salleExamen=mySalleEaxamen, patient=myPatient, region=myRegion)
            self.loggin.warning("Detail Examen Enregistre")
     
            import requests
            import configparser
            cfg = configparser.ConfigParser()
            cfg.read('Config/easydose.cfg')
            URL=cfg.get('POSTTRAITEMENT', 'urltraitement1') + str(myPatient.id)
            login=cfg.get('POSTTRAITEMENT', 'auth1')
            password=cfg.get('POSTTRAITEMENT', 'passwd1') 
            if login!= "-1":
                resp=requests.get(url=URL,auth=(login,password))
                self.loggin.warning("Request result: %s",resp)
            else:
                resp=requests.get(url=URL)
                self.loggin.warning("Request result: %s",resp)