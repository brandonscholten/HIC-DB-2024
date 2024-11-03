# session management:
# create_session - generate a session token, associate it with a user_id, set expiration data, add to sessions table
#                  if the user doesn't exist, return an error
# validate_session - return true if a user's session hasn't expired, delete the session and return false if it has

import subprocess as sp
import secrets
from datetime import datetime, timedelta
from flask import jsonify
import json

def create_session(user_email, user_pass):
    session_id = secrets.token_hex(16)
    expiration = datetime.now() + timedelta(hours=1)
    process = sp.Popen(
        ['php','./php/create_session.php',session_id, user_email, user_pass, str(expiration)],
        stdout=sp.PIPE,
        stderr=sp.PIPE
    )
    stdout, stderr = process.communicate()
    if process.returncode != 0:
        print(f"Error creating session: {stderr.decode()}")
    return stdout.decode()

def validate_session(session_id):
    process = sp.Popen(
        ['php','./php/validate_session.php',session_id, str(datetime.now()), str(datetime.now()+timedelta(hours=1))],
        stdout=sp.PIPE,
        stderr=sp.PIPE
    )
    stdout, stderr = process.communicate()
    if process.returncode != 0:
        print(f"Error validating session: {stderr.decode()}")
        return False
    response = json.loads(stdout.decode())
    if "error" in response: 
        print("Error validating session: "+response['error'])
        return False
    return True

def add_interests_restrictions(user_id, interests, restrictions):
    #add entries to interests table
    interests_process = sp.Popen(
        ['php','./php/add_user_details.php', str(user_id), 'interests'] + interests,
        stdout=sp.PIPE,
        stderr=sp.PIPE
    )
    stdout_interests, stderr_interests = interests_process.communicate()
    if interests_process != 0:
        print(f"Error adding user interests: {stderr_interests.decode()}")

    #add entries to food restrictions table
    restrictions_process = sp.Popen(
        ['php', './php/add_user_details.php', str(user_id), 'restrictions'] + restrictions,
        stdout=sp.PIPE,
        stderr=sp.PIPE
    )
    stdout_restrictions, stderr_restrictions = restrictions_process.communicate()
    if restrictions_process.returncode != 0:
        print(f"Error adding user restrictions: {stderr_restrictions.decode()}")

    return jsonify({
        "user_interests" : stdout_interests.decode(),
        "user_restrictions" : stdout_restrictions.decode()
    })
