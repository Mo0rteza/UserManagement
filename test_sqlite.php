<?php
try {
    $pdo = new PDO('sqlite:' . __DIR__ . '/database/database.sqlite');
    echo "SQLite connection successful!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
