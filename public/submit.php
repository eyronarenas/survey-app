<?php
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getPDO();

    $answers = [
        'Q1' => $_POST['Q1'] ?? null,
        'Q2' => $_POST['Q2'] ?? null,
        'Q3' => $_POST['Q3'] ?? null,
    ];

    if (in_array(null, $answers, true)) {
        echo json_encode(['success' => false, 'message' => 'Please answer all questions.']);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO survey_answers (answers) VALUES (:answers)");
    $stmt->execute(['answers' => json_encode($answers)]);

    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request.']);
