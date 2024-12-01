<?php
//tell php we are sending a JSON response
header('content-type: application/json');

//get data from args passed with Python
$session_id = $argv[1];

//get SQL connection information from environment variables
$sql_host = getenv("K_GO_HOST");
$sql_user = getenv("K_GO_USER");
$sql_pass = getenv("K_GO_PASS");
$database = getenv("K_GO_DATA");

//connect to the SQL server
$mysqli = new mysqli($sql_host, $sql_user, $sql_pass, $database);

//select from favorite places where user.id = favorite_place.user_id
//and from place where favorite_place.place_id = place.id
$query = $mysqli->prepare("
    SELECT p.* 
    FROM favorite_places fp
    JOIN place p ON fp.place_id = p.place_id 
    WHERE fp.user_id = (SELECT user_id FROM session WHERE session_id = ?)
");
$query->bind_param("s", $session_id);
$query->execute();
$query->bind_result(
    $id,
    $name,
    $primary_photo,
    $photos,
    $description,
    $rating,
    $link_to_google_maps,
    $suitable_for_all_ages,
    $allergens_present,
    $category
);

//create response array
$places = [];
while ($query->fetch()) {
    $places[] = array(
        'name' => $name,
        'image' => $primary_photo,
        'photos' => $photos,
        'description' => $description,
        'rating' => $rating,
        'mapsLink' => $link_to_google_maps,
        'allAges' => $suitable_for_all_ages,
        'allergensPresent' => $allergens_present,
        'category' => $category
    );
}

$query->close();

//send information back to the client
echo json_encode($places);

?>