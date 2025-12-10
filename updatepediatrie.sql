UPDATE patient SET ispediatrie=1 WHERE DATEDIFF(datenaissance, CURRENT_DATE())/365>=-18;
UPDATE patient SET ispediatrie=0 WHERE DATEDIFF(datenaissance, CURRENT_DATE())/365<-18;