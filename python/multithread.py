#-*- encoding: UTF-8 -*-
import threading,queue,os

def main(inargs): 
    work_queue = queue.Queue()     #queue类中实现了锁
    for i in range(3):#设置了3个子进程
        worker = Worker(work_queue,i)     #工作线程（工作队列，线程编号）
        worker.daemon = True                  #不死的，守护进程
        worker.start()                        #启动线程
    for elemt in inargs: 
        work_queue.put(elemt)              #加入到队列中，开始喂养各个线程
    work_queue.join()                       #队列同步


class Worker(threading.Thread):
    #继承线程类
    def __init__(self, work_queue,number): 
        super().__init__() 
        self.work_queue = work_queue   
        self.number = number

    def process(self,elemt):#自定义的线程处理函数，用于run（）中，这里仅仅打印线程号和传入参数
        print("\n{0}  task:----{1}".format(self.number,elemt))


    def run(self): #重载threading类中的run()
        while True: 
            try: 
                elemt = self.work_queue.get() #从队列取出任务
                self.process(elemt) 
            finally: 
                self.work_queue.task_done() #通知queue前一个task已经完成

if __name__=="__main__":
    main(os.listdir(".")) #这里用当前目录下得文件名作测试
