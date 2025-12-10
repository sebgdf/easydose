class SimpleRegion:
    def __init__(self):
        self.nom=""
        self.code=""
    def load(self,region):
        self.nom=str(region.nom)
        self.code=str(region.code)
    def insert(self):
        from Region import Region
        from datetime import datetime
        region=Region(nom=self.nom,code=self.code)
        return region