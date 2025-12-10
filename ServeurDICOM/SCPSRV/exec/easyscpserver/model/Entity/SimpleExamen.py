
class SimpleExamen:
    def __init__(self):
        self.date = ""
        self.nomCabinet = ""
        self.studydate = ""
        self.studytime = ""
        self.studydescription = ""
        self.seriesdescription = ""
        self.manufacturer = ""
        self.manufacturermodelname = ""      
    def load(self,Examen):
        self.date = str(Examen.date)
        self.nomCabinet = str(Examen.nomCabinet)
        self.studydate = str(Examen.studydate)
        self.studytime = str(Examen.studytime)
        self.studydescription = str(Examen.studydescription)
        self.seriesdescription = str(Examen.seriesdescription)
        self.manufacturer = str(Examen.manufacturer)
        self.manufacturermodelname = str(Examen.manufacturermodelname)

    def insert(self,nom_cabinet,mysalleExamen,mypatient,myRegion):
        from Examen import Examen
        from datetime import datetime
        examen =Examen(manufacturermodelname=self.manufacturermodelname,manufacturer=self.manufacturer,seriesdescription=self.seriesdescription,studydescription=self.studydescription,studytime=float(self.studytime), studydate=datetime.strptime(self.studydate,"%Y-%m-%d %H:%M:%S"),date=datetime.strptime(self.date,"%Y-%m-%d %H:%M:%S"), nomCabinet=nom_cabinet, salleExamen=mysalleExamen, patient=mypatient, region=myRegion)
        return examen