import sys
from log import *

sys.path.append("/root/zhao/code/python")
class mylog(log):
    def __init__(self, file):   
        self.file = file

        def write(self, data):
            print 'ok'
