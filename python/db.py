#-*- encoding: gb2312 -*-
import os, sys, string
import MySQLdb

# �������ݿ⡡
try:
    conn = MySQLdb.connect(host='10.229.12.32',user='root',passwd='root',db='vocabulary')
except Exception, e:
    print e
    sys.exit()

# ��ȡcursor���������в���

cursor = conn.cursor()

'''
# ������
sql = "create table if not exists test1(name varchar(128) primary key, age int(4))"
cursor.execute(sql)
# ��������
sql = "insert into test1(name, age) values ('%s', %d)" % ("zhaowei", 23)
try:
    cursor.execute(sql)
except Exception, e:
    print e

sql = "insert into test1(name, age) values ('%s', %d)" % ("����", 21)
try:
    cursor.execute(sql)
except Exception, e:
    print e
# �������

sql = "insert into test1(name, age) values (%s, %s)" 
val = (("����", 24), ("����", 25), ("����", 26))
try:
    cursor.executemany(sql, val)
except Exception, e:
    print e
'''
#��ѯ������
sql = "select * from book limit 10"
cursor.execute(sql)
alldata = cursor.fetchall()
# ��������ݷ��أ���ѭ�����, alldata���и���ά���б�
if alldata:
    for rec in alldata:
        print rec[0], rec[1]


cursor.close()

conn.close()