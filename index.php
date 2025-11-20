<?php

$request = $_SERVER['REQUEST_URI'];

switch (true) {
    case strpos($request, 'addTask.php') !== false:
        require 'addTask.php';
        break;
    case strpos($request, 'readTask.php') !== false:
        require 'readTask.php';
        break;
    case strpos($request, 'deleteTask.php') !== false:
        require 'deleteTask.php';
        break;
    case strpos($request, 'updateTask.php') !== false:
        require 'updateTask.php';
        break;
    default:
        echo json_encode(["message" => "PHP backend running"]);
}