class SimplePatient:
    def __init__(self):
        self.nom=""
        self.prenom=""
        self.sex=""
        self.numipp=""
        self.datenaissance=""
        self.age=""
        self.uniteage=""
        self.idregional=""
        self.nrdhavealerte=""
        self.sumhavealerte=""
        self.nbdoses=""
        self.havenotes=""
    def load(self,Patient):
        self.nom=str(Patient.nom)
        self.prenom=str(Patient.prenom)
        self.sex=str(Patient.sex)
        self.numipp=str(Patient.numipp)
        self.datenaissance=str(Patient.datenaissance)
        self.age=str(Patient.age)
        self.uniteage=str(Patient.uniteage)
        self.idregional=str(Patient.idregional)
        self.nrdhavealerte=str(Patient.nrdhavealerte)
        self.sumhavealerte=str(Patient.sumhavealerte)
        self.nbdoses=str(Patient.nbdoses)
        self.havenotes=str(Patient.havenotes)

    def insert(self):
        from Patient import Patient
        from datetime import datetime
        PatientOlds=Patient.selectBy(nom=self.nom,prenom=self.prenom,datenaissance=datetime.strptime(self.datenaissance,"%Y-%m-%d %H:%M:%S"))
        if(PatientOlds.count()>0):
            print("patient trouvé !!!")
            return PatientOlds
        else:
            print('Nouveau Patient => insertion')                  
            myPatient = Patient(havenotes=int(self.havenotes),nbdoses=int(self.nbdoses),sumhavealerte=int(self.sumhavealerte),nrdhavealerte=int(self.nrdhavealerte),idregional="_",sex=self.sex,uniteage=self.uniteage,prenom=self.prenom, nom=self.nom, numipp=self.numipp, datenaissance=datetime.strptime(self.datenaissance,"%Y-%m-%d %H:%M:%S"), age=int(self.age))
            patientid=myPatient.id
            id_regional='GL_ED_'+format(patientid,'09')
            myPatient.idregional=id_regional
            return myPatient
        