import re
from Google import Create_Service
import os
import io
from googleapiclient.http import MediaIoBaseDownload

import requests
import pandas as pd
import docx
import time
import schedule
import datetime
from ast import While
import mysql.connector as con

CLIENT_SECRET_FILE = 'client_secret_Googleusercontent.json'
API_NAME = 'drive'
API_VERSION = 'v3'
SCOPES = ['https://www.googleapis.com/auth/drive']
service = Create_Service(CLIENT_SECRET_FILE, API_NAME, API_VERSION, SCOPES)

cnx = con.connect(user='root', password='', host='127.0.0.1', database='linenotify')
cur = cnx.cursor()
print(service)

