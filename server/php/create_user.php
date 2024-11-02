<?php
//tell php we are sending a JSON response
header( "content-type: application/json" );

//get data from args passed with python
$user_name = $argv[1];
$user_email = $argv[2];
$user_pass = $argv[3];
$user_pronouns = $argv[4];
$user_age = $argv[5];
$user_photo = $argv[6];
$user_interests = $argv[9];
$user_restrictions = $argv[10];

//get SQL connection information from environment variables
$sql_host = getenv("K_GO_HOST");
$sql_user = getenv("K_GO_USER");
$sql_pass = getenv("K_GO_PASS");
$database = getenv("K_GO_DATA");

//connect to the SQL server
$mysqli = new mysqli($sql_host, $sql_user, $sql_pass, $database);

//check if the user already exists TODO: might want to make a view for this
$existing_user = $mysqli->prepare("SELECT name FROM user WHERE email = ?");
$existing_user->bind_param("s", $user_email);
if (!$existing_user->execute()) {
    echo "Execute failed: " . htmlspecialchars($existing_user->error)
}

$fetched_user_name = '';

$existing_user->bind_result($fetched_user_name);
$user->fetch();
$user->close();


if ($fetched_user_name == '') {
    //create the user
    $insert_stmt = $mysqli->prepare("INSERT INTO user(name, email, password, pronouns, age, photo) VALUES (?, ?, ?, ?, ?, ?)");
    if (!insert_stmt) {
        echo "error: " . $mysqli->error;
    }
    $insert_stmt->bind_params("ssssss", $user_name, $user_email, $user_pass, $user_pronouns, $user_age, $user_photo);
    $insert_stmt->execute();

    //add user interests and food restriction
    

} else {
    $jsonAnswer = array('error', => 'user with this email already exists');
}

?>