#-*- encoding: UTF-8 -*-
import threading,queue,os

def main(inargs): 
    work_queue = queue.Queue()     #queue����ʵ������
    for i in range(3):#������3���ӽ���
        worker = Worker(work_queue,i)     #�����̣߳��������У��̱߳�ţ�
        worker.daemon = True                  #�����ģ��ػ�����
        worker.start()                        #�����߳�
    for elemt in inargs: 
        work_queue.put(elemt)              #���뵽�����У���ʼι�������߳�
    work_queue.join()                       #����ͬ��


class Worker(threading.Thread):
    #�̳��߳���
    def __init__(self, work_queue,number): 
        super().__init__() 
        self.work_queue = work_queue   
        self.number = number

    def process(self,elemt):#�Զ�����̴߳�����������run�����У����������ӡ�̺߳źʹ������
        print("\n{0}  task:----{1}".format(self.number,elemt))


    def run(self): #����threading���е�run()
        while True: 
            try: 
                elemt = self.work_queue.get() #�Ӷ���ȡ������
                self.process(elemt) 
            finally: 
                self.work_queue.task_done() #֪ͨqueueǰһ��task�Ѿ����

if __name__=="__main__":
    main(os.listdir(".")) #�����õ�ǰĿ¼�µ��ļ���������
