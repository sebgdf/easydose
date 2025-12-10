from LoadExamen import LoadExamen

loadExamen=LoadExamen('/home/dicomserver/Config/easydose.cfg')

list=loadExamen.listExamennotsended()
for id in list:
    loadExamen.export(id)
