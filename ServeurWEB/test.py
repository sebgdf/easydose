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






from pydicom import dcmread
from pydicom.uid import ImplicitVRLittleEndian,ExplicitVRLittleEndian

from pynetdicom import AE, VerificationPresentationContexts
from pynetdicom.sop_class import CTImageStorage, MRImageStorage,ComputedRadiographyImageStorage,SecondaryCaptureImageStorage,XRayRadiationDoseSRStorage,XRayAngiographicImageStorage,DigitalMammographyXRayImageStorageForPresentation


import logging

LOGGER = logging.getLogger('pynetdicom')
LOGGER.setLevel(logging.DEBUG)
ae = AE(ae_title=b'MY_STORAGE_SCU')
# We can also do the same thing with the requested contexts
ae.requested_contexts = VerificationPresentationContexts
# Or we can use inbuilt objects like CTImageStorage.
# The requested presentation context's transfer syntaxes can also
#   be specified using a str/UID or list of str/UIDs
ae.add_requested_context(CTImageStorage,
                         transfer_syntax=ExplicitVRLittleEndian)
# Adding a presentation context with multiple transfer syntaxes
ae.add_requested_context(SecondaryCaptureImageStorage,
                         transfer_syntax=[ExplicitVRLittleEndian,
                                          '1.2.840.10008.5.1.4.1.1.7'])

# Adding a presentation context with multiple transfer syntaxes
ae.add_requested_context(XRayRadiationDoseSRStorage,
                         transfer_syntax=[ExplicitVRLittleEndian,
                                          '1.2.840.10008.5.1.4.1.1.7'])
ae.add_requested_context(XRayAngiographicImageStorage,
                         transfer_syntax=[ExplicitVRLittleEndian,
                                          '1.2.840.10008.5.1.4.1.1.12.1'])

ae.add_requested_context(DigitalMammographyXRayImageStorageForPresentation ,
                         transfer_syntax=[ExplicitVRLittleEndian,
                                          '1.2.840.10008.5.1.4.1.1.1.2'])


addr="127.0.0.1"
port=11112
assoc = ae.associate(addr, port)
if assoc.is_established:
    import os
    list = os.listdir('../DCM/')
    for fichier in list:
        if "dcm" in fichier:
                print(fichier)
                dataset = dcmread("../DCM/"+fichier)#'../DCM/DCM2/SR1.3.46.670589.33.1.63689357450437198500002.4900636711515240818.dcm')
                # `status` is the response from the peer to the store request
                # but may be an empty pydicom Dataset if the peer timed out or
                # sent an invalid dataset.
                status = assoc.send_c_store(dataset)

    assoc.release()
