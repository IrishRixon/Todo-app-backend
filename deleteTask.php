<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

require 'db.php';

$id = $_GET['id'] ?? null;

$stmt = $db->prepare("DELETE FROM tasks WHERE id = :id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->execute();

echo json_encode(["statusCode" => 200]);
