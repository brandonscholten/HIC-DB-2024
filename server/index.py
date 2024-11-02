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

@app.route("/create_user")
def create_user():
    #create a user account, then create a session with that account
    user_info = request.args.to_dict(flat=False)
    creation_process = sp.Popen(
        [
            'php','./php/create_user.php', 
            user_info['name'], 
            user_info['email'],
            user_info['password'], 
            user_info['pronouns'],
            user_info['age'],
            user_info['photo']
        ],
        stdout=sp.PIPE,
        stderr=sp.PIPE
    )
    stdout_creation, stderr_creation = creation_process.communicate()
    if process.returncode != 0:
        print(f"Error creating user: {stderr_creation.decode()}")
    
    #create a session with the new user
    stdout_session = session_utils.create_session(user_info['email'], user_info['password'])

    return {
        stdout_creation.decode(),
        stdout_session.decode()
    }

