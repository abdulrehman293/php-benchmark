<?php
header('Content-Type: application/json');

// Replace the strings on the right with your exact Cloudways credentials
$host = getenv('DB_HOST') ?: '127.0.0.1'; 
$db   = getenv('DB_NAME') ?: 'qjxdamwxfw';
$user = getenv('DB_USER') ?: 'qjxdamwxfw';
$pass = getenv('DB_PASS') ?: 'qjxdamwxfw';
$port = getenv('DB_PORT') ?: '5432';

$dsn = "pgsql:host=$host;port=$port;dbname=$db;";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO_ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $stmt = $pdo->query('SELECT * FROM products LIMIT 10');
    $products = $stmt->fetchAll();

    echo json_encode($products);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database query failed']);
}