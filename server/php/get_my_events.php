<?php
//tell php we are sendign a JSON response
header("content-type: application/json");

//get data from args with Python
$session_id = $argv[1];

//get SQL connection information from environment variables
$sql_host = getenv("K_GO_HOST");
$sql_user = getenv("K_GO_USER");
$sql_pass = getenv("K_GO_PASS");
$database = getenv("K_GO_DATA");

//connect to the SQL server
$mysqli = new mysqli($sql_host, $sql_user, $sql_pass, $database);

//select from event component view where user.id = event.organizer
$query = $mysqli->prepare("
    SELECT ev.*
    FROM organizes org
    JOIN event_component_view ev ON org.user_id = ev.organizer_id
    WHERE org.user_id = (SELECT user_id FROM session WHERE session_id = ?)
");
$query->bind_param("s", $session_id);
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