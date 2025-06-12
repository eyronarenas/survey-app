<?php

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getPDO();

    $answers = [
        'Q1' => $_POST['Q1'] ?? null,
        'Q2' => $_POST['Q2'] ?? null,
        'Q3' => $_POST['Q3'] ?? null,
    ];

    if (in_array(null, $answers, true)) {
        exit('Please answer all questions.');
    }

    $stmt = $pdo->prepare("INSERT INTO survey_answers (answers) VALUES (:answers)");
    $stmt->execute(['answers' => json_encode($answers)]);

    echo "<p style='text-align:center;'>Survey submitted successfully!</p>";
    echo "<p style='text-align:center;'><a href='index.php'>Back</a></p>";
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}
