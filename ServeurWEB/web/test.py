#import pydicom,numpy

#dose = pydicom.dcmread("../DCM/SR1.2.392.200046.100.13.4362.5960573.20190307111825567.1.1.1.dcm")
#print "test1"

#print dose.ContentSequence[0]

#print "=====================================";
#d=numpy.fromstring(dose.PixelData,dtype=numpy.int16)
#print "test2"

#for key in dose.dir():
#	value = getattr(dose, key, '')
#	if type(value) is pydicom.uid.UID or key == "PixelData":
#		continue
#	print "%s: %s" % (key,value)

#d=d.reshape((dose.,dose.Columns,dose.Rows))

#print "test3"





import pynetdicom.sop_class as sop_classes
from pydicom import dcmread
from pydicom.uid import ImplicitVRLittleEndian,ExplicitVRLittleEndian

from pynetdicom import AE, VerificationPresentationContexts
from pynetdicom.sop_class import *

import logging
import traceback

LOGGER = logging.getLogger('pynetdicom')
LOGGER.setLevel(logging.DEBUG)
ae = AE(ae_title=b'MY_STORAGE_SCU')
ae.maximum_contexts = 500
print(f"Limite Max Contextes: {ae.maximum_contexts}")
## We can also do the same thing with the requested contexts
#ae.requested_contexts = VerificationPresentationContexts
## Or we can use inbuilt objects like CTImageStorage.
## The requested presentation context's transfer syntaxes can also
##   be specified using a str/UID or list of str/UIDs
#ae.add_requested_context(CTImageStorage,
#                         transfer_syntax=ExplicitVRLittleEndian)
## Adding a presentation context with multiple transfer syntaxes
#ae.add_requested_context(SecondaryCaptureImageStorage,
#                         transfer_syntax=[ExplicitVRLittleEndian,
#                                          '1.2.840.10008.5.1.4.1.1.7'])
#
## Adding a presentation context with multiple transfer syntaxes
#ae.add_requested_context(XRayRadiationDoseSRStorage,
#                         transfer_syntax=[ExplicitVRLittleEndian,
#                                          '1.2.840.10008.5.1.4.1.1.7'])
#
## Adding a presentation context with multiple transfer syntaxes
#ae.add_requested_context(DigitalMammographyXRayImagePresentationStorage,
#                         transfer_syntax=[ExplicitVRLittleEndian,
#
#                                           '1.2.840.10008.5.1.4.1.1.7'])

TRANSFER_SYNTAXES = [ExplicitVRLittleEndian, ImplicitVRLittleEndian] 

# 2. 🛑 DÉFINITION MANUELLE DES UIDs DE STOCKAGE (La source des erreurs) 🛑
# Ceci est l'ensemble des UIDs DICOM pour le stockage, vérifié par le standard.
# Nous utilisons les UIDs car ils sont universellement valides.
STORAGE_SOP_UIDS = [
    # Classes SOP de Vérification et de Base
    UID('1.2.840.10008.1.1'),            # VerificationSOPClass
    
    # Classes SOP d'Imagerie Multi-Modale
    UID('1.2.840.10008.5.1.4.1.1.2'),    # CT Image Storage
    UID('1.2.840.10008.5.1.4.1.1.4'),    # MR Image Storage
    UID('1.2.840.10008.5.1.4.1.1.7'),    # Secondary Capture Image Storage
    
    # Classes SOP de Mammographie (celles qui posaient problème)
    UID('1.2.840.10008.5.1.4.1.1.1.2'),  # Digital Mammography X-Ray Image Storage - Presentation
    UID('1.2.840.10008.5.1.4.1.1.1.2.1'),# Digital Mammography X-Ray Image Storage - Processing

    # Classes SOP de Rapport Structuré (pour la Dose, comme dans votre code commenté)
    UID('1.2.840.10008.5.1.4.1.1.88.33'),# XA/XRF Radiation Dose SR Storage
    UID('1.2.840.10008.5.1.4.1.1.88.11'),# Basic Text SR Storage
    # ... ajouter ici d'autres UIDs si vous en avez besoin ...
]

print(f"Tentative d'ajout de {len(STORAGE_SOP_UIDS)} SOP de Stockage par UID.")

# 3. Boucle d'ajout
for sop_uid in STORAGE_SOP_UIDS:
    try:
        # Ajout du contexte : l'objet UID est passé directement
        ae.add_requested_context(sop_uid, transfer_syntax=TRANSFER_SYNTAXES)
    except Exception as e:
        print(f"Erreur lors de l'ajout de l'UID {sop_uid} : {e}")
        break 

print(f"\n✅ {len(ae.requested_contexts)} classes SOP ajoutées.")

addr="192.168.1.54"
port=11112
assoc = ae.associate(addr, port)
if assoc.is_established:
    import os
    list = os.listdir('/home/sebastien/easydosedocker/easydose/DCM')
    for fichier in list:
        if "dcm" in fichier:
            print(fichier) 
    	    	#try:
            dataset = dcmread("/home/sebastien/easydosedocker/easydose/DCM/"+fichier)#'../DCM/DCM2/SR1.3.46.670589.33.1.63689357450437198500002.4900636711515240818.dcm')
    	    		# `status` is the response from the peer to the store request
    	    		# but may be an empty pydicom Dataset if the peer timed out or
    	    		# sent an invalid dataset.
            try:
                status = assoc.send_c_store(dataset)
            except :
                print("Error: %s",traceback.format_exc())
	#os.remove('/home/sebastien/websrv/starter-symfony/web/upload/'+fichier);
    assoc.release()
