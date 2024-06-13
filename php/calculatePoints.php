<?php
require('conn.php');
session_start();

if(isset($_POST['user_id']))
{
    $user_id = $_POST['user_id'];
} else {
    $user_id = $_SESSION['user_id'];
}

$answers = $_POST['question'];

$hasUser = "SELECT * FROM UserAnswers WHERE user_id = $user_id";
$result = $conn->query($hasUser);
if ($result->num_rows == 0) {
    // $conn->query("DELETE FROM UserAnswers WHERE user_id = $user_id");
    $sum = 0;
    foreach ($answers as $key => $answer) {
        $sql = "INSERT INTO UserAnswers (user_id, answer_id, question_id) VALUES ($user_id, $answer, $key)";
        $sum += $answer;
        $conn->query($sql);
    }

    $add_time = "UPDATE Users SET test_time = NOW() WHERE id = $user_id";
    $conn->query($add_time);
}

header("Location: ../pages/endTest.php");