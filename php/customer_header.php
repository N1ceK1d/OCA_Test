<?php
    session_start();
    require("../../php/conn.php");
    $res = mysqli_fetch_assoc($conn->query("SELECT Customers.*, Companies.name as company_name 
    FROM Customers
    INNER JOIN Companies ON Customers.company_id = Companies.id 
    WHERE Customers.id = ".$_SESSION['customer_id']));    
?>
<header class="my-2 border-bottom py-1">
    <div class="access_info border p-1 bg-light">
        <h2><?php echo $res['login']; ?></h2>
        <h3><?php echo $res['company_name']; ?></h3>
        <p><b>Количество вопросов:</b> 10/<?php echo $res['answers_count']; ?></p>
        <p><b>Оставшееся время:</b> <?php
        // Установка временной зоны для объекта DateTime
        date_default_timezone_set("Europe/Moscow");

        // Создание объекта DateTime для текущего времени
        $now = new DateTime();

        // Предполагается, что $row['time_count'] содержит дату в формате 'Y-m-d H:i:s'
        // Преобразование строки в объект DateTime
        $ref = DateTime::createFromFormat('Y-m-d H:i:s', $res['time_count']);

        // Проверка на корректность создания объекта DateTime
        if ($ref === false) {
            echo "Некорректный формат времени";
        } else {
            // Вычисление разницы между двумя датами
            $diff = $now->diff($ref);

            // Вывод разницы в формате 'Y-m-d H:i:s'
            echo $diff->format('%y лет, %m месяцев, %d дней, %h часов, %i минут, %s секунд');
        }
        ?></p>
    </div>
    <nav>
        <a class='btn btn-outline-primary my-1' href="employees.php">Результаты сотрудников</a>
        <a class='btn btn-outline-primary my-1' href="companies.php">Компании</a>
        <a class='btn btn-outline-danger float-end my-1' href="../../php/exit.php">Выйти</a>
    </nav>
</header>