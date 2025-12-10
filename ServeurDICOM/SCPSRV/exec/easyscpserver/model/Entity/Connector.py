from sqlobject.mysql import builder

class Connector:
    
    
    _cfg  = 2
    _conn  = 3
    
    @property
    def cfg(self):
        return type(self._cfg)
    
    @cfg.setter
    def cfg(self,val):
        type(self)._cfg=val
    
    @property
    def conn(self):
        return type(self._conn)
    
    @conn.setter
    def conn(self,val):
        type(self)._conn=val   
    
    @staticmethod    
    def connect(cfg):
        _cfg=cfg
        _conn = builder()(user=cfg.get('BDD', 'user'), password=cfg.get('BDD', 'password'),
        host=cfg.get('BDD', 'host'), db=cfg.get('BDD', 'db'))
        
    @staticmethod    
    def getConnection():
        return _conn