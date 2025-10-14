<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

require 'db.php';

$input = file_get_contents("php://input");
$data = json_decode($input, true);

$id = $data['id'] ?? null;
$task = $data['task'] ?? null;

$stmt = $db->prepare("UPDATE tasks SET task = :task WHERE id = :id");
$stmt->bindValue(':task', $task, SQLITE3_TEXT);
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->execute();

echo json_encode(["statusCode" => 200]);
