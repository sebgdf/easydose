#!/bin/bash
dest=$1
sens=$2
if [ 'easydose1' = $dest ] ; then
	scp easydose@192.168.1.54:/home/easydose/work/infocomreunion/$dest/.env  /tmp/.envtmp$dest
fi
if [ 'installer' = $dest ] ; then
	scp easydose@192.168.1.54:/home/easydose/work/infocomreunion/$dest/installerinfocomreunion/.env  /tmp/.envtmp$dest
fi
if [ 'easydose' = $dest ] ; then
 	 ssh  root@192.168.1.54 "rm -fr /home/easydose/work/infocomreunion/$dest/easydose/*"
	 ssh  root@192.168.1.54 "chmod 777 -R /home/easydose/work/infocomreunion/$dest/easydose/"
	 ssh  easydose@192.168.1.54 "mkdir  /home/easydose/$dest"
	 ssh  easydose@192.168.1.54 "mkdir  /home/easydose/$dest/easydose/"
	 if ["revert" = $sens ] ; then
		cd .. && rm -fr /home/sebastien/easydosedocker/easydose/* && scp -r easydose@192.168.1.54:/home/easydose/$dest/easydose/* /home/sebastien/easydosedocker/easydose/ 
	 else
	 	scp -r * easydose@192.168.1.54:/home/easydose/$dest/easydose	 
	 fi
    	
	ssh  easydose@192.168.1.54 "mv /home/easydose/$dest/easydose/* /home/easydose/work/infocomreunion/$dest/easydose/"
	ssh  easydose@192.168.1.54 "rm -fr /home/easydose/$dest/easydose/"
fi
if [ 'installer' = $dest ] ; then
	 ssh  root@192.168.1.54 "rm -fr /home/easydose/work/infocomreunion/$dest/installerinfocomreunion/*"
	 ssh  root@192.168.1.54 "chmod 777 -R /home/easydose/work/infocomreunion/$dest/installerinfocomreunion/"
	 ssh  easydose@192.168.1.54 "mkdir  /home/easydose/$dest"
	 ssh  easydose@192.168.1.54 "mkdir  /home/easydose/$dest/installerinfocomreunion/"
     scp -r * easydose@192.168.1.54:/home/easydose/$dest/installerinfocomreunion
	 ssh  easydose@192.168.1.54 "mv /home/easydose/$dest/installerinfocomreunion/* /home/easydose/work/infocomreunion/$dest/installerinfocomreunion/"
	 ssh  easydose@192.168.1.54 "rm -fr /home/easydose/$dest/installerinfocomreunion/"
fi

if [ 'easydose1' = $dest ] ; then
	scp /tmp/.envtmp$dest easydose@192.168.1.54:/home/easydose/work/infocomreunion/$dest/.env
	ssh  easydose@192.168.1.54 "rm -f /home/easydose/work/infocomreunion/$dest/copytoinfocomreunion.sh/"
fi
if [ 'installer' = $dest ] ; then
	scp /tmp/.envtmp$dest easydose@192.168.1.54:/home/easydose/work/infocomreunion/$dest/installerinfocomreunion/.env 
	ssh  easydose@192.168.1.54 "rm -f /home/easydose/work/infocomreunion/$dest/copytoinfocomreunion.sh/"
fi


exit $?