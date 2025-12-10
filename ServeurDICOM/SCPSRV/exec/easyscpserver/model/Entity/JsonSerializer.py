import json
import pyconvert.pyconv
from json import JSONEncoder
class JsonSerializer:

    def serialise(self,_object_to_serialize,filename):
        objectconverted=pyconvert.pyconv.convert2JSON(_object_to_serialize)
        with open(filename, 'w') as f:
            f.write(str(objectconverted))
    
    def deserialize(self,classname,filename):
        # opening the JSON file
        data = open(filename).read()
         #print(filename)
        #print(data.replace("'", "\""))
        jsonreturn=json.loads(data.replace("'", "\""))
        obj = pyconvert.pyconv.convertJSON2OBJ(classname,jsonreturn)
        return obj
