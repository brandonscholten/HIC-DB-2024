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

    # add entries to interests and restrictions tables
    user_info_message = session_utils.add_interests_restrictions(user_id, user_info.get('interest', []), user_info.get('restriction', []))
    
    #create a session with the new user
    stdout_session = session_utils.create_session(user_info['email'][0], user_info['password'][0])

    return jsonify({
        "creation_message" : stdout_creation.decode(),
        "user_info_message" : user_info_message,
        "session_message" : stdout_session
    })

@app.route('/update_user/')
def update_user():
    user_info = request.args.to_dict(flat=False)

    #check that the user has a valid session
    if not session_utils.validate_session(user_info['session_id'][0]):
        return jsonify({"error" : "failed to validate session"})

    #if the user has a valid session, update their profile
    update_process = sp.Popen(
        [
            'php','./php/update_user.php', 
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
    stdout_update, stderr_update = update_process.communicate()
    if update_process.returncode != 0:
        print(f"Error updating user: {stderr_update.decode()}")

    #get user_id from update_user.php output
    user_id = ''
    if json.loads(stdout_update.decode())['error'] != '':
        return jsonify({"error" : "user with this email does not exist"})

    user_id = json.loads(stdout_update.decode())['id']

    #update the user's interests and restrictions
    user_info_message = session_utils.add_interests_restrictions(user_id, user_info.get('interest', []), user_info.get('restriction', []))

    #return result
    return jsonify({
        "update_message" : stdout_update.decode(),
        "user_info_message" : user_info_message
    })

@app.route('/get_user/')
def get_user():
    user_info = request.args.to_dict(flat=False)

    #check that the user has a valid session
    if not session_utils.validate_session(user_info['session_id'][0]):
        return jsonify({"error" : "failed to validate session"})

    #if the user has a valid session, grab their information
    process = sp.Popen(
        [
            'php','./php/get_user.php', 
            user_info['session_id'][0],
        ],
        stdout=sp.PIPE,
        stderr=sp.PIPE
    )   
    stdout, stderr = process.communicate()
    if process.returncode != 0:
        print(f"Error getting user: {stderr.decode()}")
    
    #return the information
    return jsonify({
        "user_info" : stdout.decode()
    })

@app.route('/delete_user/')
def delete_user():
    user_info = request.args.to_dict(flat=False)

    #check that the user has a valid session
    if not session_utils.validate_session(user_info['session_id'][0]):
        return jsonify({"error" : "failed to validate session"})

    #delete the user using the session id
    process = sp.Popen(
        [
            'php', 'php/delete_user.php',
            user_info['session_id'][0],
        ],
        stdout=sp.PIPE,
        stderr=sp.PIPE
    )
    stdout, stderr = process.communicate()
    if process.returncode != 0:
        print(f"Error deleting user: {stderr.decode()}")

    return jsonify({
        "response" : stdout.decode()
    })

    #TODO: may want to immediately invalidate the session to prevent future errors

@app.route('/create_event/')
def create_event():
    info = request.args.to_dict(flat=False)

    #check that the user has a valid session
    if not session_utils.validate_session(info['session_id'][0]):
        return jsonify({"error" : "failed to validate session"})

    #create an event associated with the user
    process = sp.Popen(
        [
            'php', 'php/create_event.php',
            info['session_id'][0],
            info['event_name'][0],
            info['description'][0],
            info['place'][0]
        ],
        stdout = sp.PIPE,
        stderr = sp.PIPE
    )
    stdout, stderr = process.communicate()
    if process.returncode != 0:
        print(f"Error creating event: {stderr.decode()}")

    return jsonify({
        "response" : stdout.decode()
    })

@app.route('/get_places')
def get_places():
    #get an object with all of the place information in the database
    #TODO: in the future if there's a significant number of places, loading them all at once is bad
    process = sp.Popen(
        ['php', 'php/get_places.php'],
        stdout = sp.PIPE,
        stderr = sp.PIPE
    )
    stdout, stderr = process.communicate()
    if process.returncode != 0:
        print(f"Error retrieving places: {stderr.decode()}")

    return jsonify({
        "response" : stdout.decode()
    })

