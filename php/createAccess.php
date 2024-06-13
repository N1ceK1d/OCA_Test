<?php
    require("conn.php");
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $company_id = $_POST['company_id'];
    $sql = "INSERT INTO Customers (login, password, company_id) 
    VALUES ('$login', '$password', $company_id)";

    if($conn->query($sql))
    {
        if(isset($_POST['question_count']) && $_POST['question_count'] != '')
        {
            $conn->query("UPDATE Customers SET answers_count = ".$_POST['question_count']." WHERE id = ".$conn->insert_id);
        }
    
        if(isset($_POST['time_count']) && $_POST['time_count'] != '')
        {
            $conn->query("UPDATE Customers SET time_count = '".$_POST['time_count']."' WHERE id = ".$conn->insert_id);
        }
    
        header("Location: ../pages/_admin/companies.php");
    }

?>