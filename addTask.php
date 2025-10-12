<?php
header("Access-Control-Allow-Origin: *"); // allow all origins (or specify Angular app)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require 'db.php';

$input = file_get_contents("php://input");
$data = json_decode($input, true);

$task = $data['task'] ?? null;
$createdAt = $data['createdAt'] ?? null;

if ($task) {
    $stmt = $db->prepare("INSERT INTO tasks (task, createdAt) VALUES (:task, :createdAt)");
    $stmt->bindValue(':task', $task, SQLITE3_TEXT);
    $stmt->bindValue(':createdAt', $createdAt, SQLITE3_TEXT);
    $stmt->execute();
    echo json_encode(["message" => "Task successfully added"]);
} else {
    http_response_code(400);
}
