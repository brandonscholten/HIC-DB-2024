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

//get SQL connection information from environment variables
$sql_host = getenv("K_GO_HOST");
$sql_user = getenv("K_GO_USER");
$sql_pass = getenv("K_GO_PASS");
$database = getenv("K_GO_DATA");

//connect to the SQL server
$mysqli = new mysqli($sql_host, $sql_user, $sql_pass, $database);

//check if the user already exists TODO: might want to make a view for this
$existing_user = $mysqli->prepare("SELECT id FROM user WHERE email = ?");
$existing_user->bind_param("s", $user_email);
if (!$existing_user->execute()) {
    echo "Execute failed: " . htmlspecialchars($existing_user->error);
}

$fetched_user_id = '';

$existing_user->bind_result($fetched_user_id);
$existing_user->fetch();
$existing_user->close();


if ($fetched_user_id == '') {
    //create the user
    $insert_stmt = $mysqli->prepare("INSERT INTO user(name, email, password, pronouns, age, photo) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$insert_stmt) {
        echo "error: " . $mysqli->error;
    }
    $insert_stmt->bind_param("ssssss", $user_name, $user_email, $user_pass, $user_pronouns, $user_age, $user_photo);
    $insert_stmt->execute();
    $insert_stmt->close();
    $new_user = $mysqli->prepare("SELECT id FROM user WHERE email = ?");
    $new_user->bind_param("s", $user_email);
    if (!$new_user->execute()) {
        echo "Execute failed: " . htmlspecialchars($new_user->error);
    }
    $new_user->bind_result($fetched_user_id);
    $new_user->fetch();
    $new_user->close();
    $jsonAnswer = array('id' => $fetched_user_id, "error" => '');
    echo json_encode($jsonAnswer);
} else {
    $jsonAnswer = array('error' => 'user with this email does not exist');
    echo json_encode($jsonAnswer);
}

?>