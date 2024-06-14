<?php
session_start();
session_destroy();
$admin = $_GET['admin'];
$customer = $_GET['customer'];
if(isset($_GET['admin']))
{
    header("Location: ../pages/_admin/login.php");
} if (isset($_GET['customer'])) 
{
    header("Location: ../pages/_customer/login.php");
}
