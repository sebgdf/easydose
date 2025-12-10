import logging
import configparser
from InfocomReunionEvent import InfocomReunionEvent
class Login(logging.Handler):
    """
    Handler qui intercepte les messages de pynetdicom et les passe à une autre logique.
    """
    
    def emit(self, record):
        """
        Méthode appelée pour chaque événement de log émis par le logger 'pynetdicom'.
        """

        niveau = record.levelname
        message_formate = self.format(record) # Utilise le Formatter si défini
        
        # 💡 ICI, vous utilisez votre "autre classe" ou système externe.
        self.transmettre_a_mon_systeme(niveau, message_formate)

    def transmettre_a_mon_systeme(self, niveau, message):
        """ Simule l'appel de votre classe de journalisation préférée. """
        # Vous pouvez faire ici tout ce que vous voulez : 
        # - Écrire dans une base de données
        # - Envoyer à un serveur de logs (Splunk, Graylog, etc.)
        # - Appeler une méthode statique de votre API de gestion d'événements
        
        # Exemple : affichage simple pour démonstration
        #print(f"[{niveau}] -> JOURNAL EXTERNE TRAITÉ : {message}")
        self.eventloggin.log(message,niveau)

    def __init__(self,_file):

        super().__init__() 

        self.cfg = configparser.ConfigParser()
        self.cfg.read(_file)
        self.eventloggin=InfocomReunionEvent(_file)
        logging.basicConfig(filename=self.cfg.get('LOG', 'fileName'), level=logging.DEBUG, format='%(asctime)s %(message)s')
        self.loggin=logging

    def error(self,message,*args):
        self.loggin.error(message,args)
        self.eventloggin.error(message,args)

    def log(self,message,*args):
        self.loggin.log(message,args)
        self.eventloggin.log(message,args)

    def warning(self,message,*args):
        self.loggin.warning(message,args)
        self.eventloggin.warning(message,args)
