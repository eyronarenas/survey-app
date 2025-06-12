<?php
$survey = require __DIR__ . '/../config/survey.php';
$title = $survey['title'];
$questions = $survey['questions'];
$choices = $survey['choices'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="../public/css/style.css">
    <script src="../public/js/script.js" defer></script>
</head>

<body>
    <div class="container">
        <h1 class="title"><?= htmlspecialchars($title) ?></h1>
        <form action="submit.php" method="post" id="surveyForm">
            <?php $index = 1; ?>
            <?php foreach ($questions as $key => $label): ?>
                <div class="question-block">
                    <div class="question-title"><?= $index++ ?>. <?= htmlspecialchars($label) ?></div>
                    <div class="options" data-question="<?= $key ?>">
                        <?php foreach ($choices as $value => $text): ?>
                            <button type="button" class="option" data-value="<?= $value ?>">
                                <?= htmlspecialchars($text) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    <input type="hidden" name="<?= $key ?>" required>
                </div>
            <?php endforeach; ?>

            <div class="submit-section">
                <button type="submit" class="submit-btn">SUBMIT</button>
            </div>
            <div class="toast" id="toast">Survey submitted successfully!</div>
        </form>
    </div>

</body>

</html>