import requests
from datetime import datetime
import configparser

class InfocomReunionEvent(object):

    def __init__(self,addrconfig):
        '''
        Constructor
 
        '''
        ENDPOINT="api/"
        HEADERS = {
            'Accept': 'application/ld+json',        # Format attendu en retour
            'Content-Type': 'application/ld+json'  # Format des données envoyées
        }
        

        self.HEADERS = HEADERS 

        self.cfg = configparser.ConfigParser()
        self.cfg.read(addrconfig)

        self.event_programmename=self.cfg.get('EVENT', 'programmename')
        self.event_servername=self.cfg.get('EVENT', 'servername')
        self.event_username=self.cfg.get('EVENT', 'username')
        self.serverurl=self.cfg.get('EVENT', 'serverurl')
        self.API_ENDPOINT = self.serverurl+ENDPOINT
    def geteventtypebymane(self,name):
        function="eventtypes?eventname="+name
        message=self.sendGetMessage(function)
        #print(message['member'][0]['@id'])
        return message['member'][0]['@id']

    def error(self,message, *args):
        self.log(message,'ERROR',args)

    def warning(self,message, *args):
        self.log(message,'WARNING',args)

    def log(self,message,level="", *args):
        message_formate = message
        # 1. Vérification si des arguments de formatage (*args) ont été passés
        if args:
            try:
                # 2. Application du formatage style C (%s, %d, etc.)
                message_formate = message % args
            except TypeError as e:
                # Gère les erreurs si le formatage ne correspond pas aux arguments
                message_formate = f"ERREUR DE FORMATAGE: {message} ({e})"

        self.postevent(message_formate,
                                      self.event_programmename,
                                      self.event_servername,"",self.event_username,
                                      self.geteventtypebymane('PROGRAMME_EVENT'),level)
    def postevent(self,message,programmename,servername,url,username,eventtype,level):
        function="events"
        now_utc = datetime.utcnow()
        date_du_jour = now_utc.isoformat() + 'Z'
        payload= {
            "message": message,
            "eventdate": date_du_jour, 
            "programmename": programmename,
            "servername": servername,
            "url": url,
            "username": username,
            "eventtype": "/api/eventtypes/1",  # L'IRI de la ressource Eventtype
            "readed": False
            }
        if payload:
            payload["url"]=url
        if not level:
            payload["level"]="DEBUG"
        else:
            payload["level"]=level
        message=self.sendPostMessage(function,payload)

    def sendPostMessage(self,function,payload):
        try:
            response = requests.post(self.API_ENDPOINT+function, headers=self.HEADERS,json=payload)

            # Vérification du statut HTTP
            response.raise_for_status() 

            # Conversion de la réponse JSON en objet Python (dictionnaire/liste)
            donnees = response.json() 
            #print("Données récupérées avec succès :")
            #print(donnees) 
            return donnees

        except requests.exceptions.HTTPError as err:
            #print(f"Erreur HTTP: {err}")
            return {
                exit : -1,
                message: f"Erreur HTTP: {err}"
            }
        except requests.exceptions.RequestException as err:
            #print(f"Erreur de connexion/requête: {err}")
            return {
                exit : -1,
                message : f"Erreur de connexion/requête: {err}"
            }


    def sendGetMessage(self,function):
            try:
                #print(self.API_ENDPOINT+function)
                response = requests.get(self.API_ENDPOINT+function, headers=self.HEADERS)

                # Vérification du statut HTTP
                response.raise_for_status() 

                # Conversion de la réponse JSON en objet Python (dictionnaire/liste)
                donnees = response.json() 
                #print("Données récupérées avec succès :")
                #print(donnees) 
                return donnees
            except requests.exceptions.HTTPError as err:
                #print(f"Erreur HTTP: {err}")
                return f"Erreur HTTP: {err}"
            except requests.exceptions.RequestException as err:
                #print(f"Erreur de connexion/requête: {err}")
                return f"Erreur de connexion/requête: {err}"

#SERVER="http://localhost:784/"
#http://localhost:784/api/eventtypes?eventname=PROGRAMME_EVENT
#infocomReunionEvent=InfocomReunionEvent(SERVER,ENDPOINT,HEADERS)
#eventtype=infocomReunionEvent.geteventtypebymane('PROGRAMME_EVENT')


####################################
#Exemple
#
####################################
#SERVER="http://localhost:784/"
#infocomReunionEvent=InfocomReunionEvent('/home/sebastien/infocomreunion/eventclient/python/Config/easydose.cfg')
#infocomReunionEvent.error("Envoi d'un message desespérant %s",'toto')
