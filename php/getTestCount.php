<?php
    function getTestCount($company_id, $conn, $customer_id) 
    {
        session_start();
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
        WHERE Customers.id = $customer_id"));  

        return $res['test_count'] - $test_count;
    }

    function getTestCount2($company_id, $conn) 
    {
        session_start();
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
        WHERE Customers.company_id = $company_id"));  

        return $res['test_count'] - $test_count;
    }

    function timeIsEnd($time_count)
    {
        $now = new DateTime();

        // Предполагается, что $row['time_count'] содержит дату в формате 'Y-m-d H:i:s'
        // Преобразование строки в объект DateTime
        if ($time_count != null) {
            $ref = DateTime::createFromFormat('Y-m-d H:i:s', $time_count);
            // Проверка на корректность создания объекта DateTime
            if ($ref === false) {
                echo "Некорректный формат времени";
            } else {
                // Если текущее время больше или равно времени события, устанавливаем разницу в ноль
                if ($now >= $ref) {
                    return false;
                } else {
                    // Вычисление разницы между двумя датами
                    $diff = $now->diff($ref);
                    return true;
                }
            }
        } else {
            return true;
        }
    }
?>