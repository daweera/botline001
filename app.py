
# -*- coding: utf-8 -*-
from ast import If
import json
import os
from tokenize import group
from httplib2 import Authentication
from linebot import *
from linebot import LineBotApi
from linebot.exceptions import LineBotApiError
from linebot.models import  MessageEvent
from linebot.models import  SourceUser
from linebot.models import  SourceRoom
from flask import Flask
from flask import request
from flask import make_response
from flask import Flask, jsonify
from numpy import source
import requests
import mysql.connector

mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="linenotify"
)
cur = mydb.cursor()

# Flask app should start in global layout
app = Flask(__name__)
line_bot_api = LineBotApi('IsAPldxoibVZs7hewnH5EORvGMDbQwXfYRnaqCIZ0U32Jq4NAaVR2LSFV+PId0z3sAWh5wBJZDS1ifNHZyuktXwLeKaouZnEwVnnNR/KHG2gJO032UsKu6QalZW/HcJLVLl4zxmmr8aQvKXyLtqh9gdB04t89/1O/w1cDnyilFU=')
handler = WebhookHandler('9895ef59b7876d1e4243e6f493954cad')

@app.route('/webhook', methods=['POST','GET'])
def webhook():
        payload = request.json
    #    print(payload)
        event = payload['events'][0]['type']
        header = { "Authorization": "Bearer " + 'IsAPldxoibVZs7hewnH5EORvGMDbQwXfYRnaqCIZ0U32Jq4NAaVR2LSFV+PId0z3sAWh5wBJZDS1ifNHZyuktXwLeKaouZnEwVnnNR/KHG2gJO032UsKu6QalZW/HcJLVLl4zxmmr8aQvKXyLtqh9gdB04t89/1O/w1cDnyilFU='}          
        if event == 'memberJoined':
                
                GroupId = payload['events'][0]['source']['groupId']
      #print(GroupId)
                    
      #print("Have member Join!!")
                UserID = payload['events'][0]['joined']['members'][0]['userId']
      #print(UserID)
                r=requests.get("https://api.line.me/v2/bot/group/"+GroupId+"/member/"+UserID,headers=header)
                adduser(r.text,GroupId)
        if event == 'join':
                GroupId = payload['events'][0]['source']['groupId']
         #       print(GroupId)
                r=requests.get("https://api.line.me/v2/bot/group/"+GroupId+"/summary",headers=header)
                
                addgroup(r.text)
        return "OK"

def adduser(args,groupid):
        try:
                global mydb
                data= args.split('"')
                userid = data[3]
                displayName = data[7]
                pictureUrl = data[11]
                sql ='insert into userr(userid,username,urlpicture,grouplineID) values(%s,%s,%s,%s)'
                data = (userid,displayName,pictureUrl,groupid)
                cur.execute(sql,data)
                mydb.commit()               
        except:
                None 
def addgroup(args): 
        try:
                global mydb
                data = args.split('"')
                groupid = data[3]
                groupName = data[7]
                pictureUrl = data[11]
                sql ='insert into groupline(grouplineID,groupname,urlpicturegroup) values(%s,%s,%s)'
                data = (groupid,groupName,pictureUrl) 
                cur.execute(sql,data)
                mydb.commit()
        except:
                None
        
        

if __name__ == '__main__':
    port = 8000
    print("Starting app on port %d" % port)

    app.run(port =8000)
    

from fastapi import FastAPI

app =FastAPI()

@app.get("/")
def  homepage():
        return {"message": "Hello,world!"}

def webhook1():
    line_bot_api = LineBotApi('<channel access token>')

@app.route('/')
def index():
        return "Method used:%s" % request.method
@app.route("/bacon", methods=['GET', 'POST'])
def bacon(): 
        if request.method == 'POST':
                return "You are using Post"
        else:
                return "You are probably using Get"
if __name__ =="__main__":
        app.run()
        


