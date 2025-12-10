'''
Created on 16 mai 2019

@author: sebastien
'''

import sys
import time
sys.path.append("Entity")

from Replay import Replay
replay=Replay()
while True:
    replay.replay()
    time.sleep( 240 )
    
