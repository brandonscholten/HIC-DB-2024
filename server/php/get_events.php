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

//get event and place information from event_component_view
$query = $mysqli->prepare("SELECT * FROM event_component_view");
$query->execute();
$query->bind_result(
    $organizer_id,
    $event_name,
    $organizer_name,
    $event_description,
    $organizer_photo,
    $place_name,
    $place_description,
    $rating,
    $link_to_google_maps,
    $primary_photo,
    $photos
);

//create response array
$events = [];
while ($query->fetch()) {
    $events[] = array(
        "event_name" => $event_name,
        "organizer_name" => $organizer_name,
        "event_description" => $event_description,
        "organizer_photo" => $organizer_photo,
        "place_name" => $place_name,
        "place_description" => $place_description,
        "rating" => $rating,
        "link_to_google_maps" => $link_to_google_maps,
        "primary_photo" => $primary_photo,
        "photos" => $photo
    );
}   

$query->close();

//send information back to the client
echo json_encode($events);

?>