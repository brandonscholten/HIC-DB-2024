#this file will handle API routes, each route takes the form of a PHP file that executes a query and returns a result
#all code in the server folder should not be available to the client

from flask import Flask, session
import subprocess as sp
import session_utils

app = Flask(__k_go__)

#routes 
@app.route("/login/<email>/<password>")
def login(email, password):
    #TODO: hash password to match whatever is in the database
    #validate credentials, create a session if credentials are valid
    session_utils.create_session(email, password)