<?php
//tell php we are sendign a JSON response
header( 'content-type: application/json' );

//get data from args passed with python
$user_name = $argv[2];
$user_email = $argv[3];
$user_pass = $argv[4];
$user_pronouns = $argv[5];
$user_age = $argv[6];
$user_photo = $argv[7];

//get SQL connection information from envrionment variables
$sql_host = getenv("K_GO_HOST");
$sql_user = getenv("K_GO_USER");
$sql_pass = getenv("K_GO_PASS");
$database = getenv("K_GO_DATA");

//connect to the SQL server
$mysqli = new mysqli($sql_host, $sql_user, $sql_pass, $database);

//check that the user exists and fetch their id
$user = $mysqli->prepare("SELECT id FROM user WHERE email = ?");
$user->bind_param("s", $user_email);
if (!$user->execute()) {
    echo "Execute failed: " . htmlspecialchars($user->error);
}
$fetched_user_id = '';
$user->bind_result($fetched_user_id);
$existing_user->fetch();
$existing_user->close();

if ($fetched_user_id != '') {
    //update the user
    $update_stmt = $mysqli->prepare("UPDATE user SET name = ?, email = ?, password = ?, pronouns = ?, age = ?, photo = ? WHERE user.id = ?");
    if (!$update_stmt) {
        echo "error: " . $mysqli->error;
    }
    $update_stmt->bind_param("sssssss", $user_name, $user_email, $user_pass, $user_pronouns, $user_age, $user_photo, $fetched_user_id);
    $update_stmt->execute();
    $update_stmt->close();

    //clear the interests and restrictions entries for this user
    $delete_stmt = $mysqli->prepare("DELETE interests, restrictions FROM intterests INNER JOIN restrictions WHERE interests.user_id = restrictions.user_id and interests.user_id = ?");
    if (!$delete_stmt) {
        echo "error: " . $mysqli->error;
    }
    $update_stmt->bind_param("s",$fetched_user_id);
    $delete_stmt->execute();
    $delete_stmt->close();

    //send the user id back to client
    $jsonAnswer = array('id' => $fetched_user_id, 'error' => '');
    echo json_encode($jsonAnswer);
} else {
    $jsonAnswer = array('error' => 'this user does not exist');
    echo json_encode($jsonAnswer);
}

?>