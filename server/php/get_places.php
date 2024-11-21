<?php
//tell php we are sending a JSON response
header("content-type: application/json");

//get SQL connection information from environment variables
$sql_host = getenv("K_GO_HOST");
$sql_user = getenv("K_GO_USER");
$sql_pass = getenv("K_GO_PASS");
$database = getenv("K_GO_DATA");

//connect to the SQL server
$mysqli = new mysqli($sql_host, $sql_user, $sql_pass, $database);

$query = $mysqli->prepare("SELECT * FROM place");
$query->execute();
$query->bind_result($name, $primary_photo, $photos, $description, $rating, $maps_link, $suitable_for_all_ages, $allergens_present, $category);

//create response array
$places = [];
while ($query->fetch()) {
    $places[] = array(
        'name' => $name,
        'image' => $primary_photo,
        'photos' => $photos,
        'description' => $description,
        'rating' => $rating,
        'mapsLink' => $maps_link,
        'allAges' => $suitable_for_all_ages,
        'allergensPresent' => $allergens_present,
        'category' => $category
    );
}

$query->close();

//send information back to the client
echo json_encode($places);

?>