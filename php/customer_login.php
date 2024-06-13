<?php
require('conn.php');
session_start();

$login = $_POST['login'];
$password = $_POST['password'];

$sql = "SELECT * FROM Customers WHERE login = '$login'";

$res = mysqli_fetch_assoc($conn->query($sql));
if(password_verify($password, $res['password']))
{
    $_SESSION['customer_id'] = $res['id'];
    header("Location: ../pages/_customer/index.php");
} else 
{
    header("Location: ../pages/_customer/login.php?error=1");
}

