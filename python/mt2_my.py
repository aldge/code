import threading
import time
import logging

logging.basicConfig(level=logging.DEBUG,
		format='[%(levelname)s](%(threadName)-10s)%(message)s',
		)
	
def worker2():
	logging.debug('Starting')
	time.sleep(2)
	logging.debug('Exiting')

def worker3():
	logging.debug('Starting')
	time.sleep(2)
	logging.debug('Exiting')

def daemon():
    logging.debug('Starting')
    time.sleep(2)
    logging.debug('Exiting')


def non_daemon():
    logging.debug('Starting')
    logging.debug('Exiting')

t2=threading.Thread(target=worker2,name='worker2')
t2.start()

t = threading.Thread(name='non-daemon', target=non_daemon)
t.start()

d = threading.Thread(name='daemon', target=daemon)
d.setDaemon(True)
d.start()

t3=threading.Thread(name='worker3',target=worker3)
t3.setDaemon(True)
t3.start()





