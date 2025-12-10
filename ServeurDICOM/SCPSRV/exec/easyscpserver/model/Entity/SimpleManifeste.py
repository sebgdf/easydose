class SimpleManifeste:
    def __init__(self):
        self.etablissement=""
        self.ippetablissementpatient=""
        self.datetransmission=""
        self.transmissionok=""
        self.numtransaction=""
        self.status=""
        idexamensource=0
        idexamencible=0
        idpatientsource=0
        idpatientcible=0
    def load(self,manifeste):
        self.etablissement=str(manifeste.etablissement)
        self.ippetablissementpatient=str(manifeste.ippetablissementpatient)
        self.datetransmission=str(manifeste.datetransmission)
        self.transmissionok=str(manifeste.transmissionok)
        self.numtransaction=str(manifeste.numtransaction)
        self.status=str(manifeste.status)
        self.idexamensource=str(manifeste.idexamensource)
        self.idexamencible=str(manifeste.idexamencible)
        self.idpatientsource=str(manifeste.idpatientsource)
        self.idpatientcible=str(manifeste.idpatientcible)

    def insert(self):
        from Manifeste import Manifeste
        from datetime import datetime
        ManifesteOlds=Manifeste.selectBy(numtransaction=self.numtransaction)
        if(ManifesteOlds.count()>0):
            print("manifeste  trouvé !!! rien à faire")
            for ManifesteTmp in ManifesteOlds:
                if(ManifesteTmp.status == "TRANSMISSION OK"):
                    print("Transmission déja traitée")
                    return None
                else :
                    print("Transmission KO récupération Manifeste")
                    return Manifeste
        else:
            mymanifeste = Manifeste(etablissement=self.etablissement,ippetablissementpatient=self.ippetablissementpatient,datetransmission=datetime.strptime(self.datetransmission,"%Y-%m-%d %H:%M:%S"),transmissionok=int(self.transmissionok),numtransaction=self.numtransaction,status="TRANSMISSION OK",idexamensource=int(self.idexamensource),idexamencible=int(self.idexamencible),idpatientsource=int(self.idpatientsource),idpatientcible=int(self.idpatientcible))
            mymanifeste.transmissionok=1
            return mymanifeste