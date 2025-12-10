class SimpleRegionDose:
    def __init__(self):
        self.date=""
    def load(self,Region_Dose):
        self.date=str(Region_Dose.date)
    def insert(self,_dose,_region):
        from Region_Dose import RegionDose
        from datetime import datetime
        regionDose=RegionDose(region=_region,dose=_dose,date=datetime.strptime(self.date,"%Y-%m-%d %H:%M:%S"))
        return regionDose