# session management:
# create_session - generate a session token, associate it with a user_id, set expiration data, add to sessions table
#                  if the user doesn't exist, return an error
# validate_session - return true if a user's session hasn't expired, delete the session and return false if it has

import subprocess as sp
import secrets
from datetime import datetime, timedelta

def create_session(user_email, user_pass):
    session_id = secrets.token_hex(16)
    expiration = datetime.now() + timedelta(hours=1)
    sp.Popen(['php','./php/create_session.php',session_id, user_email, user_pass, str(expiration)]).communicate()

def validate_session(session_id):
    sp.Popen(['php','./php/validate_session.php',session_id, datetime.now(), datetime.now()+timedelta(hours=1)]).communicate()
