<?php
    require("conn.php");
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $company_id = $_POST['company_id'];
    $time_count = isset($_POST['time_count']) ? $_POST['time_count'] : null;
    $question_count = isset($_POST['question_count']) ? $_POST['question_count'] : null;
    $sql = "INSERT INTO Customers (login, password, company_id, answers_count, time_count) 
    VALUES ('$login', '$password', $company_id, $question_count, '$time_count')";

    echo $sql."<br>";

    if($conn->query($sql))
    {
        header("Location: ../pages/_admin/companies.php");
    }

?>