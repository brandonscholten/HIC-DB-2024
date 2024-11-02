<?php

//tell php we are sending a JSON response
header( "content-type: application/json" );

//get user_id 
$user_id = $argv[1];
$table = $argv[2];

//get SQL connection information from envrionment variables
$sql_host = getenv("K_GO_HOST");
$sql_user = getenv("K_GO_USER");
$sql_pass = getenv("K_GO_PASS");
$database = getenv("K_GO_DATA");

//connect to the SQL server
$mysqli = new mysqli($sql_host, $sql_user, $sql_pass, $database);

//set column appropriately
$column = 'interest';
if ($table === 'restrictions') {
    $column = 'restriction';
}

//loop through arguments and insert interests or food restrictions for the user
for ($x = 3; $x < $argc; $x++) {
    $insert_stmt = $mysqli->prepare("INSERT INTO `$table`(user_id, `$column`) VALUES (?, ?)");
    if (!$insert_stmt) {
        echo "error: " . $mysqli->error;
    }
    $insert_stmt->bind_param("ss", $user_id, $argv[$x]);
    $insert_stmt->execute();
    $insert_stmt->close();
}

?>