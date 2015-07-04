import urllib2
import json
import redis
 
r = redis.Redis(host='127.0.0.1', port=6379, db=0) 

appid = "wx3eadc3ccafa2edcf"
secret = "8990d4ac28cffb18fb9038246bad5e89"
url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' + appid + '&secret=' + secret
response = urllib2.urlopen(url)
html = response.read()
tokeninfo = json.loads(html)
token = tokeninfo['access_token']

r.set('token', token)