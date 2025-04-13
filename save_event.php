<?php
// save_event.php
$eventData = json_decode(file_get_contents("php://input"), true);

if (!$eventData) {
    echo json_encode(["message" => "No data received"]);
    exit;
}

$file = 'events.json';
$existing = [];

if (file_exists($file)) {
    $json = file_get_contents($file);
    $existing = json_decode($json, true);
}

$newEvent = [
    "title" => $eventData['title'],
    "start" => $eventData['start'],
    "end" => $eventData['end'],
    "color" => "#17a2b8" // Optional: use dynamic colors
];

$existing[] = $newEvent;
file_put_contents($file, json_encode($existing, JSON_PRETTY_PRINT));

echo json_encode(["message" => "Event saved successfully"]);
