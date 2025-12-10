class SimpleDose:
    def __init__(self):
        self.modalite = ""
        self.valeur = ""
        self.kvp = ""
        self.tempsExposition = ""
        self.xrayTubeCurrent = ""
        self.date = ""
        self.protocole = ""
        self.unite = ""
    def load(self,Dose):
        self.modalite = str(Dose.modalite)
        self.valeur = str(Dose.valeur)
        self.kvp = str(Dose.kvp)
        self.tempsExposition = str(Dose.tempsExposition)
        self.xrayTubeCurrent = str(Dose.xrayTubeCurrent)
        self.date=str(Dose.date)
        self.protocole=str(Dose.protocole)
        self.unite=str(Dose.unite)
    def insert(self):
        from Dose import Dose
        from datetime import datetime
        dose=Dose(modalite=self.modalite,valeur=float(self.valeur),kvp=float(self.kvp),tempsExposition=float(self.tempsExposition),xrayTubeCurrent=int(self.xrayTubeCurrent),date=datetime.strptime(self.date,"%Y-%m-%d %H:%M:%S"),protocole=self.protocole,unite=self.unite)
        return dose