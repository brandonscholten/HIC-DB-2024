<?php
//tell php we are sending a JSON response
header( "content-type: application/json" );

//get data from args passed with python
$session_id = $argv[1];

//get SQL connection information from envrionment variables
$sql_host = getenv("K_GO_HOST");
$sql_user = getenv("K_GO_USER");
$sql_pass = getenv("K_GO_PASS");
$database = getenv("K_GO_DATA");

//connect to the SQL server
$mysqli = new mysqli($sql_host, $sql_user, $sql_pass, $database);

//TDOD replace this with a subquery?
//use the session id to get the user id
$id_query = $mysqli->prepare("SELECT user_id FROM user_session WHERE session_id = ?");
$id_query->bind_param("s", $session_id);
if (!$id_query->execute()) {
    echo "Execute failed: " . htmlspecialchars($id_query->error);
}
$fetched_user_id = '';
$id_query->bind_result($fetched_user_id);
$id_query->fetch();
$id_query->close();

if ($fetched_user_id != 0) {
    //TODO these could probably be optimized
    //use the user id to get information about the user
    $user = $mysqli->prepare("SELECT name, email, password, pronouns, age FROM user WHERE user_id = ?");
    if (!$user) {
        echo "error: " . $mysqli->error;
    }
    $user->bind_param("s", $fetched_user_id);
    $user->execute();
    $user->bind_result($name, $email, $password, $pronouns, $age);
    $user->fetch();
    $user->close();

    //get interests
    $interest_query = $mysqli->prepare("SELECT interest FROM interests WHERE user_id = ?");
    if (!$interest_query) {
        echo "error: " . $mysqli->error;
    }
    $interest_query->bind_param("s", $fetched_user_id);
    $interest_query->execute();
    $interest_query->bind_result($interest);
    $interests = [];
    while($interest_query->fetch()) {
        $interests[] = $interest;
    }
    $interest_query->close();

    //get restrictions
    $restriction_query = $mysqli->prepare("SELECT restriction FROM restrictions WHERE user_id = ?");
    if (!$restriction_query) {
        echo "error: " . $mysqli->error;
    }
    $restriction_query->bind_param("s", $fetched_user_id);
    $restriction_query->execute();
    $restriction_query->bind_result($restriction);
    while($restriction_query->fetch()) {
        $restrictions[] = $restriction;
    }
    $restriction_query->close();

    //send the inforatmion back to the client
    $jsonAnswer = array(
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'pronouns' => $pronouns,
        'age' => $age,
        'interests' => $interests,
        'restrictions' => $restrictions
    );
    echo json_encode($jsonAnswer);
} else {
    $jsonAnswer = array('error' => 'unable to find session');
    echo json_encode($jsonAnswer);
}



?>