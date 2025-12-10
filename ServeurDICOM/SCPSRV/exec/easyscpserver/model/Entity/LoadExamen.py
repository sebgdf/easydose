
from Connector import Connector 
from JsonSerializer import JsonSerializer
from sqlobject.mysql import builder

from mysql.connector.dbapi import Date
from sqlobject.sqlbuilder import Update
from sqlobject.mysql import builder
from sqlobject.mysql import mysqlconnection
from sqlobject import dbconnection
from SimpleExamen import SimpleExamen
from SimplePatient import SimplePatient
from SimplesalleExamen import SimplesalleExamen
from SimpleRegion import SimpleRegion
from SimpleRegion_Dose import SimpleRegionDose
from SimpleDose import SimpleDose
from SimpleDetailDose import SimpleDetailDose
from SimpleManifeste import SimpleManifeste
from datetime import date, datetime
import random
from sqlobject import *
class LoadExamen:

    def __init__(self,addrconfig):
        import configparser
        self.cfg = configparser.ConfigParser()
        self.cfg.read(addrconfig)
    
    def export(self,id_examen):
         #import random
        _numtransaction=datetime.now().strftime("%d%m%Y%H%M%S%f")+str(random.randint(1, 9999))    
        try:        
            #initialisationJsonserialiser
            jsonSerializer=JsonSerializer()        
            import os
            os.mkdir(self.cfg.get('SERIALISATION', 'addrexport') +'/'+_numtransaction)
            #Connection à la base de données
            sqlhub.processConnection = connectionForURI("mysql://root:Boss132@mysql:3307/easydose")
            from Examen import Examen
            
            #Récupération des données liées aux examens
            ExamenSelected=Examen.selectBy(id=id_examen)
            for ExamenSelectedTmp in ExamenSelected:
                simpleExamen=SimpleExamen()
                simpleExamen.load(ExamenSelectedTmp)
                jsonSerializer.serialise(simpleExamen,self.cfg.get('SERIALISATION', 'addrexport') +'/'+_numtransaction + "/Examen.json")

            #Récupération des données liées au Patient
            from Patient import Patient
            PatientSelected=Examen.selectBy(id=id_examen).throughTo.patient
            for PatientSelectedTmp in PatientSelected:
                simplePatient=SimplePatient()
                simplePatient.load(PatientSelectedTmp)
                jsonSerializer.serialise(simplePatient,self.cfg.get('SERIALISATION', 'addrexport')+'/'+_numtransaction + "/Patient.json")
                
            #Récupération des données liées à la  SalleExamen
            from SalleExamen import SalleExamen
            salleExamenSelected=Examen.selectBy(id=id_examen).throughTo.salleExamen
            for salleExamenSelectedTmp in salleExamenSelected:
                simplesalleExamen=SimplesalleExamen()
                simplesalleExamen.load(salleExamenSelectedTmp)
                jsonSerializer.serialise(simplesalleExamen,self.cfg.get('SERIALISATION', 'addrexport')+'/'+_numtransaction + "/SalleExamen.json")

            #Récupération région
            from Region import Region
            RegionSelected=Examen.selectBy(id=id_examen).throughTo.region
            for RegionSelectedTmp in RegionSelected:
                simpleRegion=SimpleRegion()
                simpleRegion.load(RegionSelectedTmp)            
                jsonSerializer.serialise(simpleRegion,self.cfg.get('SERIALISATION', 'addrexport')+'/'+_numtransaction + "/Region.json")
                idregion=RegionSelectedTmp.id
    
            
            #Selection de region dose
            from Region_Dose import RegionDose
            RegionDoseSelected=RegionDose.selectBy(region=idregion)
            for RegionDoseSelectedTmp in RegionDoseSelected:
                simpleRegionDose=SimpleRegionDose() 
                simpleRegionDose.load(RegionDoseSelectedTmp)           
                jsonSerializer.serialise(simpleRegionDose,self.cfg.get('SERIALISATION', 'addrexport')+'/'+_numtransaction + "/RegionDose.json")

            #Selection de la dose
            from Dose import Dose
            DoseSelected=RegionDose.selectBy(region=idregion).throughTo.dose
            for DoseSelectedTmp in DoseSelected:
                simpleDose=SimpleDose()
                simpleDose.load(DoseSelectedTmp),
                jsonSerializer.serialise(simpleDose,self.cfg.get('SERIALISATION', 'addrexport')+'/'+_numtransaction + "/DDose.json")
                iddose=DoseSelectedTmp.id
        
            
            #select Detail Dose
            i=0
            from Detail_Dose import DetailDose
            DetailDoseSelected=DetailDose.selectBy(dose=iddose)
            for DetailDoseSelectedTmp in DetailDoseSelected:
                simpleDetailDose=SimpleDetailDose()
                simpleDetailDose.load(DetailDoseSelectedTmp)
                jsonSerializer.serialise(simpleDetailDose,self.cfg.get('SERIALISATION', 'addrexport')+'/'+_numtransaction + "/DetailDose_"+str(i)+".json")
                i=i+1
            #création Manifeste

            from Manifeste import Manifeste
            manifeste=Manifeste(idpatientsource=PatientSelectedTmp.id,idexamensource=ExamenSelectedTmp.id,idexamencible=0,idpatientcible=0,etablissement=self.cfg.get('SERIALISATION', 'nometablissement'),ippetablissementpatient=simplePatient.numipp,datetransmission=datetime.now(),transmissionok=0,numtransaction=_numtransaction,status="TRANSMISSION EN ATTENTE")
            simpleManifeste=SimpleManifeste()
            simpleManifeste.load(manifeste)
            jsonSerializer.serialise(simpleManifeste,self.cfg.get('SERIALISATION', 'addrexport')+'/'+_numtransaction + "/Manifeste.json")
            import subprocess
            p=subprocess.run([self.cfg.get("SSH", 'addrsendfile')+' '+self.cfg.get('SERIALISATION', 'addrexport') +'/'+_numtransaction+' '+self.cfg.get('SSH', 'addrserver')+' '+self.cfg.get('SSH', 'sshusername')+' '+self.cfg.get('SSH', 'sshimportfile')+' '+self.cfg.get("SSH", 'sshport')], 
                           shell=True, check=True) 
            stdout, stderr = p.communicate()
        except:
            try:
                import shutil
                shutil.rmtree(self.cfg.get('SERIALISATION', 'addrexport') +'/'+_numtransaction, ignore_errors=False, onerror=None)
            except:
                print("")

    def importfile(self):
        import os
         #initialisationJsonserialiser
        jsonSerializer=JsonSerializer()  
        TableauDetailDose=[]
        for subdir in os.listdir(self.cfg.get('SERIALISATION', 'addrimport')):
            #print('.Id Export: '+ subdir)
            for file in os.listdir(self.cfg.get('SERIALISATION', 'addrimport')+'/'+subdir):
                try:
                    #print(' > file : '+file)
                    if('DetailDose' in file):                    
                        simpleDetailDose=jsonSerializer.deserialize(SimpleDetailDose,self.cfg.get('SERIALISATION', 'addrimport')+'/'+subdir+'/'+file)
                        #print('Classe Detail_Dose')
                        TableauDetailDose.append(simpleDetailDose)
                    if('Examen' in file):
                        simpleExamen=jsonSerializer.deserialize(SimpleExamen,self.cfg.get('SERIALISATION', 'addrimport')+'/'+subdir+'/'+file)
                    if('SalleExamen' in file):
                        simpleSalleExamen=jsonSerializer.deserialize(SimplesalleExamen,self.cfg.get('SERIALISATION', 'addrimport')+'/'+subdir+'/'+file)
                    if('Patient' in file):
                        simplePatient=jsonSerializer.deserialize(SimplePatient,self.cfg.get('SERIALISATION', 'addrimport')+'/'+subdir+'/'+file)
                        #print('Classe Patient')
                    if('RegionDose' in file):
                        simpleRegionDose=jsonSerializer.deserialize(SimpleRegionDose,self.cfg.get('SERIALISATION', 'addrimport')+'/'+subdir+'/'+file)
                        #print('Classe RegionDose')
                    if('DDose' in file):
                        simpleDose=jsonSerializer.deserialize(SimpleDose,self.cfg.get('SERIALISATION', 'addrimport')+'/'+subdir+'/'+file)
                        #print('Classe Dose')
                    if('Region.' in file):
                        simpleRegion=jsonSerializer.deserialize(SimpleRegion,self.cfg.get('SERIALISATION', 'addrimport')+'/'+subdir+'/'+file)
                        #print('Classe Region')
                    if('Manifeste' in file):
                        simpleManifeste=jsonSerializer.deserialize(SimpleManifeste,self.cfg.get('SERIALISATION', 'addrimport')+'/'+subdir+'/'+file)
                        #print('Classe Manifeste')
                except:
                    print("")

            #insertion en Base
            #Connection à la base de données
            try:
                if(simplePatient!=None):
                    sqlhub.processConnection = connectionForURI("mysql://root:Boss132@mysql:3307/easydose")
            
                    patient=simplePatient.insert()
                    manifeste=simpleManifeste.insert()
                    if (manifeste != None):


                        #insertion Salle Examen
                        salleExamen=simpleSalleExamen.insert()
                        #insertion Region
                        region=simpleRegion.insert()
                        #insertion Examen
                        examen=simpleExamen.insert(self.cfg.get('SERIALISATION', 'nometablissement'),salleExamen,patient,region)


                        #Insertion Dose
                        dose=simpleDose.insert()

                        #insertion Detail Dose
                        for simpleDetailDosetmp in TableauDetailDose:
                            detaildose=simpleDetailDosetmp.insert(dose)

                        #insertion RegionDOSE
                        regionDose=simpleRegionDose.insert(dose,region)

                        #Envois Manifeste Dans Dossier Traité
                        simpleManifeste.transmissionok=1
                        simpleManifeste.status="TRANSMISSION OK"
                        import os
                        try:
                            import shutil
                            shutil.rmtree(self.cfg.get('SERIALISATION', 'addrimportdone')+'/'+subdir, ignore_errors=False, onerror=None)
                        except:
                            print("")
                        #os.mkdir(self.cfg.get('SERIALISATION', 'addrimportdone')+'/'+subdir)
                        #jsonSerializer.serialise(simpleManifeste,self.cfg.get('SERIALISATION', 'addrimportdone')+'/'+subdir+'/Manifeste.json')
                        #delete #directory
            except:
                print("")

    def listExamennotsended(self):
        sqlhub.processConnection = connectionForURI("mysql://root:Boss132@mysql:3307/easydose")
        from sqlobject.sqlbuilder import NOTIN, Select
        from Examen import Examen
        from Manifeste import Manifeste        
        examens=Examen.select(NOTIN(Examen.q.id,Select(Manifeste.q.idexamensource)))
        listeids=[]
        for examen in examens:
            listeids.append(examen.id)
        print(len(listeids))
        return listeids;