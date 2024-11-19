<?php 
//tell php we are sending a JSON response
header( "content-type: application/json" );

//get data from args passed with Python
$session_id = $argv[1];
$event_name = $argv[2];
$description = $argv[3];
$place = $argv[4];

//get SQL connection information from environment variables
$sql_host = getenv("K_GO_HOST");
$sql_user = getenv("K_GO_USER");
$sql_pass = getenv("K_GO_PASS");
$database = getenv("K_GO_DATA");

//connect to SQL server
$mysqli = new mysqli($sql_host, $sql_user, $sql_pass, $database);

//create the event
$insert = $mysqli->prepare("INSERT INTO event(name, description, place) VALUES (?, ?, ?)");
if (!$insert) {
    echo "error: " . $mysqli->error;
}

$insert->bind_param("ssss", $event_name, $description, $place);
$insert->execute();
$insert->close();

//add the organizer (SELECT user_id FROM user_session WHERE id = ?)
$insert = $mysqli->prepare("INSERT INTO organizes(user_id, event_id) VALUES ()");

//response
$jsonAnswer = array('response' => 'event created');

?>