class SimpleDetailDose:
    def __init__(self):
        self.tempsExposition=""
        self.xrayTubeContent="" 
        #self.dose=str(SimpleDetailDose.dose)
        self.bodyPart=""
        self.valeur=""
        self.body_part_easydose=""
        self.unite=""
        self.protocole=""
        self.machine=""
        self.date=""
        self.modalite=""
        self.unitexrayTubeContent=""
        self.nrdhavealerte=""
        self.sumhavealerte=""
        self.nrdvaleur=""
        self.uniteseuil=""
#        self.xrayTubeContentinua=""
#        self.imageandfluoroscopyareadoseproduct=""
#        self.manufacturer=""
#        self.manufacturermodelname=""
#        self.radiationmode=""
#        self.radiationsetting=""
#        self.kvp=""
    def load(self,SimpleDetailDose):
        self.kvp=str(self.kvp)
        self.tempsExposition=str(SimpleDetailDose.tempsExposition)
        self.xrayTubeContent=str(SimpleDetailDose.xrayTubeContent)   
        #self.dose=str(SimpleDetailDose.dose)
        self.bodyPart=str(SimpleDetailDose.bodyPart)
        self.valeur=str(SimpleDetailDose.valeur)
        self.body_part_easydose=str(SimpleDetailDose.body_part_easydose)
        self.unite=str(SimpleDetailDose.unite)
        self.protocole=str(SimpleDetailDose.protocole)
        self.machine=str(SimpleDetailDose.machine)
        self.date=str(SimpleDetailDose.date)
        self.modalite=str(SimpleDetailDose.modalite)
        self.unitexrayTubeContent=str(SimpleDetailDose.unitexrayTubeContent)
        self.nrdhavealerte=str(SimpleDetailDose.nrdhavealerte)
        self.sumhavealerte=str(SimpleDetailDose.sumhavealerte)
        self.nrdvaleur=str(SimpleDetailDose.nrdvaleur)
        self.uniteseuil=str(SimpleDetailDose.uniteseuil)
#        self.xrayTubeContentinua=str(SimpleDetailDose.xrayTubeContentinua)
#        self.imageandfluoroscopyareadoseproduct=str(SimpleDetailDose.imageandfluoroscopyareadoseproduct)
#        self.manufacturer=str(SimpleDetailDose.manufacturer)
#        self.manufacturermodelname=str(SimpleDetailDose.manufacturermodelname)
#        self.radiationmode=str(SimpleDetailDose.radiationmode)
#        self.radiationsetting=str(SimpleDetailDose.radiationsetting)
    def insert(self,_dose):
        from Detail_Dose import DetailDose
        from datetime import datetime
        detaildose=DetailDose(  
        kvp=0, 
        tempsExposition=float(self.tempsExposition),
        xrayTubeContent=int(self.xrayTubeContent),
        dose=_dose,
        bodyPart=self.bodyPart,
        valeur=float(self.valeur),
        body_part_easydose=self.body_part_easydose,
        unite=self.unite,
        protocole=self.protocole,
        machine=self.machine,
        date=datetime.strptime(self.date,"%Y-%m-%d %H:%M:%S"),
        modalite=self.modalite,
        unitexrayTubeContent=self.unitexrayTubeContent,
        nrdhavealerte=int(self.nrdhavealerte),
        sumhavealerte=int(self.sumhavealerte),
        nrdvaleur=float(self.nrdvaleur),
        uniteseuil=self.uniteseuil,
#        xrayTubeContentinua=int(self.xrayTubeContentinua),
#        imageandfluoroscopyareadoseproduct=float(self.imageandfluoroscopyareadoseproduct),
#        manufacturer=self.manufacturer,
#        manufacturermodelname=self.manufacturermodelname,
#        radiationmode=self.radiationmode,
#        radiationsetting=self.radiationsetting)
        return detaildose