<?php 
function getUserResult($user_id, $username, $gender, $test_time){?>
  <div class='diagramm-item m-1 border w-100 h-100 p-1' id='diagramm_<?php echo $user_id ?>'>
    <button class='btn btn-primary get_pdf'>Скачать</button>
    <button class='btn btn-danger delete_user' role="button" type='button'
      data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="<?php echo $user_id;?>">Удалить</button>
    
    <p class="text-muted"><?php echo $gender['name']; ?></p>
    <p class="text-muted"><?php
    $time = strtotime($test_time);
    echo date("d/m/y H:i", $time);
    ?>
    </p>
    <?php
    require('conn.php');

    $sql = "SELECT sum(Answers.points) as points, Characteristics.name, Characteristics.characteristic_char FROM UserAnswers
    INNER JOIN Answers ON UserAnswers.answer_id = Answers.id
    INNER JOIN Questions ON UserAnswers.question_id = Questions.id
    INNER JOIN Characteristics ON Questions.characteristic_id = Characteristics.id
    WHERE user_id = $user_id
    GROUP BY Characteristics.characteristic_char, Characteristics.name
    ORDER By Characteristics.characteristic_char";
    $res = $conn->query($sql);

    $gender = mysqli_fetch_assoc($conn->query("SELECT Genders.name as gender FROM Users INNER JOIN Genders ON Users.gender = Genders.id WHERE Users.id = $user_id"))['gender'];
    
    while($row = $res->fetch_assoc()) {
      $myArray[] = $row;
    }
    ?>
    <canvas id="myChart<?php echo $user_id ?>" style="max-width:75%"></canvas>
    <div class="helper bg-light border p-1">
      <h3>Зоны графика</h3>
      <ul>
        <li class='row'><div class="color-block color1"></div>  - Приемлемый уровень</li>
        <li class='row'><div class="color-block color2"></div>  - Приемлемый уровень при идеальных условиях</li>
        <li class='row'><div class="color-block color3"></div>  - Желательно обратить внимание</li>
        <li class='row'><div class="color-block color4"></div>  - Срочно обратить внимание!!!</li>
      </ul>
    </div>
    
    <?php
      $company_name = "SELECT * FROM Users
      INNER JOIN Companies ON Users.company_id = Companies.id 
      WHERE Users.id = $user_id";

      $name = mysqli_fetch_assoc($conn->query($company_name));
    ?>
    <script>
      showDiagramm(<?php echo json_encode($myArray); ?>, <?php echo $user_id ?>, "<?php echo $username ?>",  "<?php echo $gender ?>",'<?php echo $name['name'] ?>');
    </script>
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Удаление тестируемого</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../php/deleteUser.php">
                        <input type="hidden" name="user_id" value="" class='user_id'>
                        <div class="mb-3">
                            <p>Вы уверены, что хотите удалить данные этого тестируемого?</p>
                        </div>
                        <button type="submit" class="btn btn-danger">Удалить</button>
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
            exampleModal.querySelector('.modal-body .user_id').value = recipient;
        })
    </script>
  </div>
<?php } ?>
