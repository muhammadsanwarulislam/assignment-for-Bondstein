<?php

use App\DatabaseConnection;
use App\InputValidator;
use App\ReviewManager;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Set the content type to JSON
header('Content-Type: application/json');

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    // Replace with your actual database connection details from .env
    $db = new DatabaseConnection($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
    $validator = new InputValidator();
    $reviewManager = new ReviewManager($db, $validator);

    $response = $reviewManager->submitReview($data);

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
