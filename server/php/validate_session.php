<?php
//tell php that we are sending a JSON response
header( "content-type: application/json" );

//get data from args passed with Python
$session_id = $argv[1];
$current_time = $argv[2];
$updated_time = $argv[3];

//get SQL connection information from environment variables
$sql_host = getenv('K_GO_HOST');
$sql_user = getenv('K_GO_USER');
$sql_pass = getenv("K_GO_PASS");
$database = getenv("K_GO_DATA");

//connect to the SQL server
$mysqli = new mysqli($sql_host, $sql_user, $sql_pass, $database);

//get information about the session
$session = $mysqli->prepare("SELECT user_id, expires_at FROM session WHERE session_id = ?");
if (!$session) {
    echo "error: " . $mysqli->error;
}
$session->bind_param("s", $session_id);
$session->execute();
$session->bind_result($user_id, $expires_at);
$session_exists = $session->fetch();
$session->close();

if ($session_exists) { //TODO: this is not running when a session exists but is invalid

    if ($current_time < $expires_at) {
        //update the session
        $update_stmt = $mysqli->prepare("UPDATE user_session SET expires_at = ? WHERE session_id = ?");
        $update_stmt->bind_param("ss", $updated_time, $session_id);
        $update_stmt->execute();
        //send a response
        $jsonAnswer = array('response' => 'session still valid');
        echo json_encode($jsonAnswer);
    } else {
        //delete the session
        $delete_stmt = $mysqli->prepare("DELETE FROM session WHERE session_id = ?");
        $delete_stmt->bind_param("s", $session_id);
        $delete_stmt->execute();
        //send a response
        $jsonAnswer = array('error' => 'session expired');
        echo json_encode($jsonAnswer);
    }
} else {
    $jsonAnswer = array('error' => 'invalid session token ' . $expires_at . '.');
    echo json_encode($jsonAnswer);
}

?>