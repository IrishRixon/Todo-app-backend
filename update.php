<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

require 'db.php';

$input = file_get_contents("php://input");
$data = json_decode($input, true);

$id = $data['id'] ?? null;
$isDone = $data['isDone'] ?? null;

$stmt = $db->prepare("UPDATE tasks SET isDone = :isDone WHERE id = :id");
$stmt->bindValue(':isDone', $isDone, SQLITE3_INTEGER);
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);

$stmt->execute();

echo json_encode(["statusCode" => 200]);
