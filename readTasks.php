<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

$date = date("F j, Y");

require 'db.php';

$stmt = $db->prepare('SELECT * FROM tasks WHERE createdAt LIKE :createdAt');
$stmt->bindValue(':createdAt', "%" . $date . "%", SQLITE3_TEXT);
$results = $stmt->execute();

$arr = array();

while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $temp = array('id' => $row['id'], 'task' => $row['task'], 'isDone' => $row['isDone'], 'createdAt' => $row['createdAt']);
    $arr[] = $temp;
}

echo json_encode($arr);
