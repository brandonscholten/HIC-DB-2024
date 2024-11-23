<?php 
//tell php we are sending a JSON response
header( "content-type: application/json" );

//get data from args passed with Python
$session_id = $argv[1];

//get SQL connection information from environment variables
$sql_host = getenv("K_GO_HOST");
$sql_user = getenv("K_GO_USER");
$sql_pass = getenv("K_GO_PASS");
$database = getenv("K_GO_DATA");

//connect to the SQL server
$mysqli = new mysqli($sql_host, $sql_user, $sql_pass, $database);

//delete user interests and restrictions by session_id
$delete = $mysqli->prepare("DELETE interests, restrictions FROM interests INNER JOIN restrictions WHERE interests.user_id = restrictions.user_id and interests.user_id = (SELECT user_id FROM session WHERE id = ?)");
if (!$delete) {
    echo "error: " . $mysqli->error;
}
$delete->bind_param("s", $session_id);
$delete->execute();
$delete->close();

//delete the user by session_id
$delete = $mysqli->prepare("DELETE FROM user WHERE user_id = (SELECT user_id FROM session WHERE session_id = ?)");
if (!$delete) {
    echo "error: " . $mysqli->error;
}
$delete->bind_param("s", $session_id);
$delete->execute();
$delete->close();

//response
$jsonAnswer = array('response' => 'user deleted');
echo json_encode($jsonAnswer);
?>