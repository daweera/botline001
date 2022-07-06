import json
import os
from httplib2 import Authentication
from linebot import *
from flask import Flask
from flask import request
from flask import make_response
import requests

# Flask app should start in global layout
app = Flask(__name__)
line_bot_api = LineBotApi('+F1QSLOwgYZr2e+NauvXfAfpxTUDqSC8ib8NL/VCQX3/F3mpSdqhSeq2QnaLZVH3YD9xMSUybWjHnjb65NdxDzmeyitozFGq8a1J/2Sz6axn6g03M4uNvaTwrY3D11+fVVB60+cdW+KLRUyJpvpexAdB04t89/1O/w1cDnyilFU=')
handler = WebhookHandler('6fe12e10494aeecaf320138e583039cf')

@app.route('/webhook', methods=['POST','GET'])
def webhook():
        payload = request.json
        print(payload)
        GroupId = payload['events'][0]['source']['groupId']
        event = payload['events'][0]['type']
        if event == "memberJoined" :
            print("Have member Join!!")
            UserID=payload['events'][0]['joined']['members'][0]['userId']
            print(UserID)
            header = { "Authorization": "Bearer " + line_bot_api}
            r=requests.get("https://api.line.me/v2/bot/group/"+GroupId+"/member/"+UserID,headers=header)
            print(r)
        print("----------------------------------------------")
#print(r)
        print("----------------------------------------------")
        print(event)
        print(GroupId)
        print("----------------------------------------------")
        print("----------------------------------------------")
        return "OK"



if __name__ == '__main__':
    port = 80

    print("Starting app on port %d" % port)

    app.run(port =80)