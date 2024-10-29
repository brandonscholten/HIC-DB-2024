#this file will handle API routes, each route takes the form of a PHP file that executes a query and returns a result
#all code in the server folder should not be available to the client

from flask import Flask, session
import subprocess as sp
import session_utils

from flask_cors import CORS

app = Flask(__name__)

# COMMENT THIS OUT IN PRODUCTION
CORS(app)

#routes 
@app.route("/login/<email>/<password>")
def login(email, password):
    #TODO: hash password to match whatever is in the database
    #validate credentials, create a session if credentials are valid
    return session_utils.create_session(email, password)
