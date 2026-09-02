<?php
header('Content-Type: application/json');

// Ensure you update 'your_password_here' before pushing!
$host = getenv('DB_HOST') ?: '127.0.0.1'; 
$db   = getenv('DB_NAME') ?: 'rudqkmvvzq';
$user = getenv('DB_USER') ?: 'rudqkmvvzq';
$pass = getenv('DB_PASS') ?: 'v3HvFmYFm5';
$port = getenv('DB_PORT') ?: '3306';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Fixed: Added the double colon
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    $stmt = $pdo->query('SELECT * FROM products LIMIT 10');
    $products = $stmt->fetchAll();

    echo json_encode($products);
} catch (Throwable $e) {
    echo json_encode([
        'error' => 'Database query failed', 
        'details' => $e->getMessage()
    ]);
}