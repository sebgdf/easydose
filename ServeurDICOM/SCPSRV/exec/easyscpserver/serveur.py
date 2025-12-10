import pydicom,numpy
from pynetdicom import AE, VerificationPresentationContexts,StoragePresentationContexts
from pydicom.uid import ImplicitVRLittleEndian,ExplicitVRLittleEndian
from pynetdicom.sop_class import CTImageStorage, MRImageStorage

ae = AE(ae_title=b'MY_ECHO_SCP')
# Or we can use the inbuilt VerificationPresentationContexts list,
#   there's one for each of the supported Service Classes
# In this case, we are supporting any requests to use Verification SOP
#   Class in the association
#ae.supported_contexts = VerificationPresentationContexts


# Add presentation contexts with specified transfer syntaxes
for context in StoragePresentationContexts:
    ae.add_supported_context(context.abstract_syntax, transfer_syntax=ExplicitVRLittleEndian)
for context in VerificationPresentationContexts:
    ae.add_supported_context(context.abstract_syntax, transfer_syntax=ExplicitVRLittleEndian)

def on_c_store(ds, context, info):
    print "recu"
    for key in ds.dir():
       value = getattr(ds, key, '')
       if type(value) is pydicom.uid.UID or key == "PixelData":
         continue
       print "%s: %s" % (key,value)
       
    return 0x0000

ae.on_c_store=on_c_store
# Start the SCP on (host, port) in blocking mode
ae.start_server(('', 11112), block=True)
