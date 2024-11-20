<?php
//tell php that we are sending a JSON response
header( "content-type: application/json" );

//get data from args passed with Python
$session_id = $argv[1];
$user_email = $argv[2];
$user_pass = $argv[3];
$expiration = $argv[4];

//get SQL connection information from environment variables
$sql_host = getenv('K_GO_HOST');
$sql_user = getenv('K_GO_USER');
$sql_pass = getenv("K_GO_PASS");
$database = getenv("K_GO_DATA");

//connect to the SQL server
$mysqli = new mysqli($sql_host, $sql_user, $sql_pass, $database);

//check for existence of user
$user = $mysqli->prepare("SELECT user_id, password FROM user WHERE email = ?");
$user->bind_param("s", $user_email);
if (!$user->execute()) {
    echo "Execute failed: " . htmlspecialchars($user->error);
} 

$fetched_user_pass = '';

$user->bind_result($fetched_user_id, $fetched_user_pass);
$user->fetch();
$user->close();

// $user->store_result();
// $user_result = $user->get_result();
// $user_info = $user_result->fetch_assoc();

//check if there's a user with the supplied user id
if ($fetched_user_pass != '') {
    //check that the user's password is correct
    if ($user_pass === $fetched_user_pass) {
        //create a session with the user's information, insert into session, return the session id
        //this information is used to authenticate the user before running other queries
        $insert_stmt = $mysqli->prepare("INSERT INTO session(session_id, user_id, expires_at) VALUES (?, ?, ?)");
        if (!$insert_stmt) {
            echo "error: " . $mysqli->error;
        }
        $insert_stmt->bind_param("sss", $session_id, $fetched_user_id, $expiration);
        $insert_stmt->execute();

        $jsonAnswer = array(
            'session_id' => $session_id
        );

        echo json_encode($jsonAnswer);
    } else {
        $jsonAnswer = array('error' => 'invalid password');
        echo json_encode($jsonAnswer);
    }
} else {
    $jsonAnswer = array('error' => 'user does not exist');
    echo json_encode($jsonAnswer);
}

?>
