<?php
    session_start();
    if(!isset($_SESSION['admin_id']))
    {
        header("Location: login.php");
    }
    require("../../php/conn.php");
    require("../../php/getTestCount.php");
    $company_id = 0;
    if(isset($_GET['company_id']))
    {
        $company_id = $_GET['company_id'];
    }
    date_default_timezone_set("Europe/Moscow");
    $date = date('m/d/Y h:i:s a', time());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доступы</title>
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../js/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="container p-1">
        <h1>Анализ характеристик личности</h1>
        <h1>Доступы</h1>
        <?php require("../../php/admin_header.php"); ?>
        <?php
            $res = $conn->query("SELECT * FROM Customers;");    
        ?>
        <div class="customers">
            <?php foreach ($res as $row):?>
                <div class="company-item cart border w-75 p-1 my-1 bg-light">
                    <h2 class="name"><?php echo $row['login']; ?></h2>
                    <div class="company_settings">
                        <i role="button" class="bi bi-trash-fill text-danger"
                        data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="<?php echo $row['id'];?>"></i><br>
                    </div>
                    <div class="access_info">
                        <form action="../../php/updateCustomer.php" method='POST'>
                            <i role="button" class="bi bi-pencil-fill text-primary"
                            data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="<?php echo $row['id'];?>"></i>
                            <p><b>Количество вопросов:</b> <?php
                            if($row['answers_count'] != null)
                            {
                                echo getTestCount($row['company_id'], $conn, $row['id'])." / ".$row['answers_count']; 
                            } else {
                                echo "-";
                            }
                            ?></p>
                            <p><b>Оставшееся время:</b> <?php
                            // Установка временной зоны для объекта DateTime
                            // Создание объекта DateTime для текущего времени
                            $now = new DateTime();

                            // Предполагается, что $row['time_count'] содержит дату в формате 'Y-m-d H:i:s'
                            // Преобразование строки в объект DateTime
                            if ($row['time_count'] != null) {
                                $ref = DateTime::createFromFormat('Y-m-d H:i:s', $row['time_count']);
                                // Проверка на корректность создания объекта DateTime
                                if ($ref === false) {
                                    echo "Некорректный формат времени";
                                } else {
                                    // Если текущее время больше или равно времени события, устанавливаем разницу в ноль
                                    if ($now >= $ref) {
                                        echo "00 лет, 00 месяцев, 00 дней, 00 часов, 00 минут, 00 секунд";
                                    } else {
                                        // Вычисление разницы между двумя датами
                                        $diff = $now->diff($ref);

                                        // Вывод разницы в формате 'Y-m-d H:i:s'
                                        echo $diff->format('%y лет, %m месяцев, %d дней, %h часов, %i минут, %s секунд');
                                    }
                                }
                            } else {
                                echo "-";
                            }?></p>
                            
                        </form>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <!--Modal Start-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Удаление доступа</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../php/deleteAccess.php">
                        <input type="hidden" name="customer_id" value="" class='customer_id'>
                        <div class="mb-3">
                            <p>Вы уверены, что хотите удалить доступ?</p>
                        </div>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal End-->
    <!--Modal Start-->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Обновить доступ</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../php/updateCustomer.php">
                        <input type="hidden" name="customer_id" value='' class='customer_id'>
                        <div class='mb-3 border p-1'>
                            <div class="mb-3 time_access">
                                <label for="">Количество времени</label>
                                <input class="form-control" min="<?php echo date('Y-m-d\TH:i'); ?>" type="datetime-local" class='time_access_value' name="time_count">
                            </div>
                            <div class="mb-3 question_access">
                                <label for="">Количество вопросов</label>
                                <input class="form-control" type="number" class='question_access_value' name="test_count" min='1'>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal End-->
    <script>
        var exampleModal = document.getElementById('exampleModal2')
        exampleModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-whatever');

            var modalBodyInput = exampleModal.querySelector('.modal-body #recipient-name ')
            console.log(recipient);
            exampleModal.querySelector('.modal-body .customer_id').value = recipient;
        });

        var exampleModal2 = document.getElementById('exampleModal3')
        exampleModal2.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-whatever');

            var modalBodyInput = exampleModal2.querySelector('.modal-body #recipient-name ')
            console.log(recipient);
            exampleModal2.querySelector('.modal-body .customer_id').value = recipient;
        });
    </script>
</body>
</html>