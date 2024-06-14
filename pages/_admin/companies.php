<?php
    session_start();
    if(!isset($_SESSION['admin_id']))
    {
        header("Location: login.php");
    }
    require("../../php/conn.php");
    $company_id = 0;
    if(isset($_GET['company_id']))
    {
        $company_id = $_GET['company_id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Компании</title>
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../js/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="container p-1">
        <h1>Анализ характеристик личности</h1>
        <h1>Предприятия</h1>
        <?php require("../../php/admin_header.php"); ?>
        <form class='border w-25 p-2 m-auto text-center' action="../../php/addCompany.php" method="post">
            <input class='form-control' type="text" name="name" id="" required placeholder='Название компании'>
            <input class="btn btn-primary my-1" type="submit" value="Добавить">
        </form>
        <?php
            $res = $conn->query("SELECT * FROM Companies;");    
        ?>
        <div class="companies">
            <?php foreach ($res as $row):?>
                <div class="company-item cart border w-75 p-1 my-1 bg-light">
                    <h2 class="name"><?php echo $row['name']; ?></h2>
                    <div class="company_settings">
                        <i role="button" class="bi bi-trash-fill text-danger"
                        data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="<?php echo $row['id'];?>"></i><br>
                    </div>
                    <button type='button' class='btn btn-primary my-1 copied_text_btn liveToastBtn'>Скопировать ссылку</button>
                    <?php $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'?company_id='.urlencode(base64_encode($row['id'])); ?>
                    <input type="hidden" class='copied_text' value='<?php echo $url ?>'>
                    <button type='button' class='btn btn-primary my-1' data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="<?php echo $row['id'];?>"
                    <?php if($conn->query("SELECT * FROM Customers WHERE company_id = ".$row['id'])->num_rows > 0) {echo "disabled";} ?>>Создать доступ</button>
                    <input type="text" readonly='true' class='form-control mt-2 my-1' value='<?php echo $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/pages/_customer/'; ?>'>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <!--Modal Start-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Удаление компании</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../php/deleteCompany.php">
                        <input type="hidden" name="company_id" value="" class='company_id'>
                        <div class="mb-3">
                            <p>Вы уверены, что хотите удалить эту компанию?</p>
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
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Создать доступ</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../php/createAccess.php">
                        <input type="hidden" name="company_id" value="" class='company_id'>
                        <div class="mb-3">
                            <label for="login">Логин</label>
                            <input required='true' type="text" class="form-control" name="login">
                        </div>
                        <div class="mb-3">
                            <label for="login">Пароль</label>
                            <input required='true' type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="login">Тип ограничения</label>
                            <select class="form-control access_type" name="access_type">
                                <option selected="selected" value="1">По времени</option>
                                <option value="2">По вопросам</option>
                                <option value="3">По вопросам и времени</option>
                            </select>
                        </div>

                        <div class='mb-3 border p-1'>
                            <div class="mb-3 time_access">
                                <label for="">Количество времени</label>
                                <input class="form-control" type="datetime-local" min="<?php echo date('Y-m-d\TH:i'); ?>" class='time_access_value' name="time_count" min='1'>
                            </div>
                            <div class="mb-3 question_access">
                                <label for="">Количество вопросов</label>
                                <input class="form-control" type="number" class='question_access_value' name="question_count" min='1'>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Создать</button>
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
            exampleModal.querySelector('.modal-body .company_id').value = recipient;
        })

        var exampleModal = document.getElementById('exampleModal3')
        exampleModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-whatever');

            var modalBodyInput = exampleModal.querySelector('.modal-body #recipient-name ')
            console.log(recipient);
            exampleModal.querySelector('.modal-body .company_id').value = recipient;
        })

        $('.copied_text_btn').click(function() {
            // Находим родительский элемент кнопки, чтобы добавить поле с URL в него
            var parent = $(this).closest('.company-item');

            // Проверяем, существует ли уже поле с URL в родительском элементе
            var urlField = parent.find('.copied_url');
            if (urlField.length === 0) {
                // Если поле не существует, создаем новое поле с URL
                urlField = $('<input>');
                urlField.attr('type', 'text');
                urlField.attr('readonly', true);
                urlField.addClass('form-control mt-2 copied_url');
                parent.append(urlField);
            }

            // Находим скрытое поле с URL в родительском элементе
            var copiedText = parent.find('.copied_text');

            // Заполняем поле с URL значением из скрытого поля
            urlField.val(copiedText.val());

            // Показываем поле с URL
            urlField.show();
        });
    </script>
    <script src="../../js/create_customer.js"></script>
</body>
</html>