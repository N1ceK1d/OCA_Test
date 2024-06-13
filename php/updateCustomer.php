<?php
    require("conn.php");
    $customer_id = $_POST['customer_id'];

    if(isset($_POST['test_count']) && $_POST['test_count'] != '')
    {
        $conn->query("UPDATE Customers SET answers_count = ".$_POST['test_count']." WHERE id = $customer_id");
    }

    if(isset($_POST['time_count']) && $_POST['time_count'] != '')
    {
        $conn->query("UPDATE Customers SET time_count = '".$_POST['time_count']."' WHERE id = $customer_id");
    }
    
    header("Location: ../../pages/_admin/customers.php");
?>