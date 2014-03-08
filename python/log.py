#! /usr/bin/env python
# -*- coding: utf-8 -*-
import time
#import pyetc
import sys
class log:
	
	def __init__(self, file):	
	
		self.file = file

	def write(self, data):

        	try:
	                path = sys.path[0]
	       	        #conf = pyetc.load(path + '/project.conf')
                	#logPath = conf.logDir + "/" + self.file + '.txt'

                	file_object = open(logPath, 'a')
               		file_object.write(time.strftime("%Y年-%m月-%d日 %H:%M:%S", time.localtime(time.time())) + ":\n")
                	file_object.write(str(data) + "\n")
                	file_object.close()
        	except Exception,e:
			print e
