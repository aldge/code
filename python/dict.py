import httplib
import urllib
user='aaa'
params=urllib.urlencode({"Text1":user})
headers={"Accept":"text/html","User-Agent":"IE","Content-Type":"application/x-www-form-urlencoded"}
website="localhost:1483"
path="/abc/(S(drixqpzt15p2dpepy5xk1enq))/Default.aspx"
conn=httplib.HTTPConnection(website)
conn.request("POST",path,params,headers)
r=conn.getresponse()
print r.status,r.reason
data=r.read()
print data
conn.close()

