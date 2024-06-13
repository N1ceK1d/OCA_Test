<?php
    require("../php/conn.php");
    session_start();
    $questions = $conn->query("SELECT Questions.* FROM Questions;");
    $has_answers = $conn->query("SELECT * FROM UserAnswers WHERE user_id = " . $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест потенциала личности</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.7.1.min.js"></script>
</head>
<body>
    <?= $has_answers->num_rows > 0 ? '<script>window.location.href = "endTest.php";</script>' : '' ?>
    <div class="container">
    <div id="liveAlertPlaceholder"></div>
        <form class="questions mx-auto p-1" method='POST' action='../php/calculatePoints.php'>
            <?php foreach($questions as $question):?>
                <div class="question bg-light border rounded p-1 w-75 my-1">
                    <p class='question-text'><b><?= $question['id'] ?>. </b><?= $question['question_text'] ?></p>
                    <div class="answers row">
                        <?php foreach ($conn->query("SELECT * FROM Answers WHERE question_id = ".$question['id']." ORDER BY id;") as $answer):?>
                            <div class="answer-item">
                                <input type="radio" class='check_input' name="question[<?= $question['id'] ?>]" value="<?= $answer['id'] ?>">
                                <label><?= $answer['answer_text'] ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <input class='end_test_btn btn btn-primary' type="button" value="Закончить тест">
        </form>
    </div>
    <script src="../js/test.js"></script>
</body>
</html>