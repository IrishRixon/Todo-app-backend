<?php 
    $db = new SQLite3('todo.db');
    
    $db->exec("CREATE TABLE IF NOT EXISTS tasks(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        task TEXT NOT NULL,
        isDone INTEGER DEFAULT 0,
        createdAt TEXT NOT NULL
    )");
?>