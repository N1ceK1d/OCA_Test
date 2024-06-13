<?php
    session_start();
    if(!isset($_SESSION['customer_id']))
    {
        header("Location: login.php");
    }
    require("../../php/conn.php");
    $company_id = mysqli_fetch_assoc($conn->query("SELECT company_id FROM Customers WHERE id = ".$_SESSION['customer_id']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Клиент</title>
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Анализ характеристик личности</h1>
        <?php require("../../php/customer_header.php") ?>
    </div>
</body>
</html>