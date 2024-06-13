<?php
  session_start();
  require("php/conn.php");
  require("php/getTestCount.php");
  $res = mysqli_fetch_assoc($conn->query("SELECT * FROM Companies LIMIT 1"));

  $company_id = $res['id'];

  if(isset($_GET['company_id']))
  {
    $company_id = base64_decode($_GET['company_id']);
  }
  $test_count = mysqli_fetch_assoc($conn->query("SELECT * FROM Customers WHERE company_id = $company_id"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест потенциала личности</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="icon" href="favicon.ico">
</head>
<body>
    <div class="container">
    <?php if(isset($_GET['company_id'])): ?>
      <?php if(getTestCount($company_id, $conn) > 0 && timeIsEnd($test_count['time_count'])): ?>
        <div class="test-intro p-1 my-1 mx-auto w-75">
            <h1>Тест: Анализ характеристик личности</h1>
            <h2>Как заполнять тест:</h2>
            <div class="helper w-100 border p-1 my-1 mx-auto bg-light rounded">
              <p>
              Время заполнения теста не ограничено, но обычно это занимает 30-40 минут <br><br>
              Важно, чтобы во время заполнения теста, вас ничего не беспокоило и не отвлекало.<br><br>
              Пожалуйста, ответьте на каждый вопрос теста. Не задерживайтесь на одном вопросе, ответьте на него сразу, как только вы его поняли, и переходите к следующему. Отвечайте так, как это происходит в вашей жизни сейчас, а не происходило в прошлом. <br><br>
              На каждый вопрос нужно выбрать только один из вариантов ответа.<br><br>
              На любой из вопросов можно ответить:
              <ul>
                <li><b>«Да»</b> – означает точно «да» или «в основном, да»,</li>
                <li><b>«Может быть»</b> – означает «может быть или не уверены в точности «да» или «нет»,</li>
                <li><b>«Нет»</b> – означает точно «нет» или «в основном, нет».</li>
              </ul>
              </p>

              <p class='text-danger text-center'><b>ВНИМАНИЕ! Тест для лиц достигших 18 лет</b></p>
            </div>
            <div class="test-button text-center">
              <button class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#exampleModal">Начать тест</button>
            </div>
        </div>
        <!--Modal start-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Данные сотрудника</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="php/addPerson.php" method="POST">
                    <div class="mb-3">
                      <label for="exampleInputName" class="form-label">Имя</label>
                      <input type="text" name='first_name' class="form-control" id="exampleInputName" aria-describedby="nameHelp">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Фамилия</label>
                      <input type="text" name='second_name' class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                      <input type="hidden" name="company_id" class="company_id" value="<?php echo $company_id ?>">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputName" class="form-label">Пол</label>
                      <select name="gender_id" class="form-select">
                        <?php foreach ($conn->query("SELECT * FROM Genders") as $gender) :?>
                          <option value="<?php echo $gender['id'] ?>"><?php echo $gender['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="btn-submit text-center">
                        <button type="submit" class="btn btn-primary">Начать тест</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--Modal end-->
        <script>
          var myModal = document.getElementById('myModal')
          var myInput = document.getElementById('myInput')

          myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
          })
        </script>
        <?php else: ?>
          <div class="container">
            <h2 class='text-center'>На данный момент тест закрыт</h2>
          </div>
        <?php endif; ?>
      <?php else :?>
        <div class="container">
          <h2 class='text-center'>Получите ссылку от руководства</h2>
        </div>
    <?php endif; ?>
    </div>
</body>
</html>