class SimplesalleExamen:
    def __init__ (self):
        self.nom=""
    def load (self,salleExamen):
        self.nom=salleExamen.nom
    def insert(self):
        from SalleExamen import SalleExamen
        salleExamen=SalleExamen(nom=self.nom)
        return salleExamen