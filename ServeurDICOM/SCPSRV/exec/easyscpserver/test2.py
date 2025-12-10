import pydicom,numpy

#dose = pydicom.dcmread("DCM/PA19316A.p03")
#dose = pydicom.dcmread("../DCM/CT1.2.840.113619.2.359.3.2248821604.993.1551929551.513.dcm")
#dose = pydicom.dcmread("/home/sebastien/git/easydose/ServeurDICOM/SCPSRV/2020-08-04_15_44_05_537958146857.dcm")
#dose = pydicom.dcmread("/home/sebastien/easydosev2/DCM/1.dcm")
dose = pydicom.dcmread("//home/sebastien/easydosev2/easydosev2/DCM/2.dcm")
#dose = pydicom.dcmread("/home/sebastien/git/easydose/2020-07-08_04_45_29_45347557291.dcm")
#dose = pydicom.dcmread("test.dcm")

for element in dose:
#        value = getattr(dose, key, '')
#        if type(value) is pydicom.uid.UID or key == "PixelData":
#        if  key == "PixelData":
#             continue
#        print(key,': ',value)
  if element.tag.elem== 6163:
      print ('=>')
      print (element.value)
					#print content2.MeasuredValueSequence.MeasurementUnitsCodeSequence.CodeMeaning 
#		for content2 in  content.ContentSequence:
	#	print content.ConceptNameCodeSequence
#			for key in content:
#				print key
#for key in dose.dir():
#	value = getattr(dose, key, '')
#	if type(value) is pydicom.uid.UID or key == "PixelData":
#		continue
#	if key == "Measured Value Sequence" :
#		print "==>|%s|: %s" % (key,value)
		#print "|** %s **|" % (content.RelationshipType )
		#print "|** %s **|" % (content.ValueType )
		#for cncs in content.ConceptNameCodeSequence:
		#for MVS in dose.ContentSequence.MeasuredValueSequence:
		#	print MVS 
			#if cncs.MeasuredValueSequence:#=="Dose Area Product Total" : #and content.RelationshipType=="CONTAINS":
			#	print cncs.MeasuredValueSequence.NumericValue
			#for mesures in cncs.MeasuredValueSequence:
			#	print mesures.NumericValue 

#		print "****************************************************************************************"

#if dose.ContentSequence
#print	dose.ContinuityOfContent
#for key in dose.dir():
#	value = getattr(dose, key, '')
#	if type(value) is pydicom.uid.UID or key == "PixelData":
#		continue
#	print "%s: %s" % (key,value)

#d=d.reshape((dose.,dose.Columns,dose.Rows))

#print "test3"






#from pydicom import dcmread
#from pydicom.uid import ImplicitVRLittleEndian,ExplicitVRLittleEndian

#from pynetdicom import AE, VerificationPresentationContexts
#from pynetdicom.sop_class import CTImageStorage, MRImageStorage,ComputedRadiographyImageStorage,SecondaryCaptureImageStorage,XRayRadiationDoseSRStorage


#import logging

#LOGGER = logging.getLogger('pynetdicom')
#LOGGER.setLevel(logging.DEBUG)
#ae = AE(ae_title=b'MY_STORAGE_SCU')
# We can also do the same thing with the requested contexts
#ae.requested_contexts = VerificationPresentationContexts
# Or we can use inbuilt objects like CTImageStorage.
# The requested presentation context's transfer syntaxes can also
#   be specified using a str/UID or list of str/UIDs
#ae.add_requested_context(CTImageStorage,
                    #     transfer_syntax=ExplicitVRLittleEndian)
# Adding a presentation context with multiple transfer syntaxes
#ae.add_requested_context(XRayRadiationDoseSRStorage,
 #                        transfer_syntax=[ExplicitVRLittleEndian,
  #                                        '1.2.840.10008.5.1.4.1.1.7'])




#addr="localhost"
#"port=11112
#assoc = ae.associate(addr, port)
#if assoc.is_established:
 #   dataset = dcmread('../DCM/SR1.2.392.200046.100.13.4362.293153.20190307111012441.1.1.1.dcm')
    # `status` is the response from the peer to the store request
    # but may be an empty pydicom Dataset if the peer timed out or
    # sent an invalid dataset.
  #  status = assoc.send_c_store(dataset)

#    assoc.release()
