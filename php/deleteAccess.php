<?php
    require("conn.php");

    $customer_id = $_POST['customer_id'];
    echo "DELETE FROM Customers WHERE id = $customer_id";
    if($conn->query("DELETE FROM Customers WHERE id = $customer_id"))
    {
        header("Location: ../pages/_admin/customers.php");
    }

?>