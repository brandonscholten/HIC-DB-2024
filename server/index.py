#this file will handle API routes, each route takes the form of a PHP file that executes a query and returns a result
#all code in the server folder should not be available to the client

from flask import Flask, session, request, jsonify
import subprocess as sp
import session_utils
import json

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

@app.route("/create_user/")
def create_user():
    #create a user account, then create a session with that account
    user_info = request.args.to_dict(flat=False)
    creation_process = sp.Popen(
        [
            'php','./php/create_user.php', 
            user_info['name'][0], 
            user_info['email'][0],
            user_info['password'][0], 
            user_info['pronouns'][0],
            user_info['age'][0],
            user_info['photo'][0],
        ],
        stdout=sp.PIPE,
        stderr=sp.PIPE
    )
    stdout_creation, stderr_creation = creation_process.communicate()
    if creation_process.returncode != 0:
        print(f"Error creating user: {stderr_creation.decode()}")

    #get the user id
    user_id = ''
    if json.loads(stdout_creation.decode())['error'] != '':
        return jsonify({"error" : "user with this email already exists"})
    
    user_id = json.loads(stdout_creation.decode())['id']

    #add entries to interests table
    interests_process = sp.Popen(
        ['php','./php/add_user_details.php', str(user_id), 'interests'] + user_info.get('interest', []), 
        stdout=sp.PIPE, 
        stderr=sp.PIPE
    )
    stdout_interests, stderr_interests = interests_process.communicate()
    if interests_process.returncode != 0:
        print(f"Error creating user: {stderr_interests.decode()}")

    #add entries to food_restrictions table
    restrictions_process = sp.Popen(
        ['php','./php/add_user_details.php', str(user_id), 'restrictions'] + user_info.get('restriction', []),
        stdout=sp.PIPE,
        stderr=sp.PIPE
    )
    stdout_restrictions, stderr_restrictions = restrictions_process.communicate()
    if restrictions_process.returncode != 0:
        print(f"Error creating user: {stderr_restrictions.decode()}")
    
    #create a session with the new user
    stdout_session = session_utils.create_session(user_info['email'][0], user_info['password'][0])

    return jsonify({
        "creation_message" : stdout_creation.decode(),
        "interests_message" : stdout_interests.decode(),
        "restrictions_message" : stdout_restrictions.decode(),
        "session_message" : stdout_session
    })


