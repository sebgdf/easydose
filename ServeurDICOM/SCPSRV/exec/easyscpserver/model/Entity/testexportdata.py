from LoadExamen import LoadExamen

loadExamen=LoadExamen('/home/dicomserver/Config/easydose.cfg')
#loadExamen.export(10920)
#loadExamen.importfile()
list=loadExamen.listExamennotsended()
for id in list:
    loadExamen.export(id)
