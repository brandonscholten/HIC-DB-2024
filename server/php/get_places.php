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
$query->bind_result($place);

//create response array
$places = [];
while ($query->fetch_assoc()) {
    $places[] = array(
        'name' => $place['name'],
        'image' => $place['primary_photo'],
        'photos' => $place['photos'],
        'description' => $place['description'],
        'rating' => $place['rating'],
        'mapsLink' => $place['link_to_google_maps'],
        'allAges' => $places['suitable_for_all_ages'],
        'allergensPresent' => $places['allergens_present'],
        'category' => $places['category']
    );
}

$query->close();

//send information back to the client
echo json_encode($places);

?>