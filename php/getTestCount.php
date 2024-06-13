<?php
    function getTestCount($company_id, $conn) 
    {
        $test_count = $conn->query("SELECT Users.*, Users.id as user_id, CONCAT(Users.second_name, ' ', Users.first_name) as fullname
        FROM Users
        INNER JOIN UserAnswers ON UserAnswers.user_id = Users.id 
        INNER JOIN Companies ON Users.company_id = Companies.id
        WHERE company_id = $company_id
        GROUP By Users.id 
        ORDER BY test_time;")->num_rows;
        
        $res = mysqli_fetch_assoc($conn->query("SELECT Customers.answers_count as test_count
        FROM Customers
        INNER JOIN Companies ON Customers.company_id = Companies.id 
        WHERE Customers.id = ".$_SESSION['customer_id']));  
        return $res['test_count'] - $test_count;
    }
?>