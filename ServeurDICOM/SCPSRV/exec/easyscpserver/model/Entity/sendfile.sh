############################################################################
## Auteur: Sébastien GIRIER-DUFOURNIER SRR
## Description : transmission des fichiers d'examen
## Date : 18/01/2023
## V: 0.0.1
############################################################################

nomfichierexport=$1
var_ssh_host=$2
var_ssh_user=$3
var_dir_remote=$4
var_sshport=$5

echo "Envois fichier de prélèvement $nomfichierexport vers $var_ssh_host......"

scp -P $var_sshport -r $nomfichierexport $var_ssh_user@$var_ssh_host:$var_dir_remote
if [ $? -eq 0 ] ; then
    echo "erreur envois"
else
    rm -fr $nomfichierexport
fi 
exit $?
 