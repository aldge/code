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

t = threading.Thread(name='non-daemon', target=non_daemon)
d = threading.Thread(name='daemon222', target=daemon)
d.setDaemon(True)

t2=threading.Thread(target=worker2,name='worker2')
t3=threading.Thread(name='worker3',target=worker3)
#t2=threading.Thread(name='worker3',target=daemon)

d.start()
t.start()

t3.setDaemon(True)
t3.start()
t2.setDaemon(True)
t2.start()


