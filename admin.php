<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    session_start();
    require_once ("lib/connect_db.php");

    // узнаем права пользователя
    $right = $connect->query("SELECT `users`.`right` FROM data_base.users where `login`='".$_SESSION['login']."'");
    if(($myrow = $right->fetch_assoc()) !=false){
      $right = $myrow["right"];
    }

    // если у пользователя достаточно прав (1 - админ, 2 - модератор, 3 - пользователь)
    if($right < 3){
          
    }else{
      // если у пользователя нет прав, перенаправляем его на главную страницу
      header("Location: /index.php ");
    }
          
?>

  <html>
  <head>
  <title>Админ панель</title>
  <link rel="stylesheet" href="/css/main.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="/css/auth_form.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="/css/no_border_bottom.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="/css/admin.css" type="text/css" charset="utf-8">

  <script type="text/javascript" src="http://localhost/lib/js/jquery-3.2.1.js"></script>


  </head>
  <body>
  
  <div id="wraper" class="">
    
    <!-- подключение шапки сайта-->
    <?php
      // Проверяем переменные логина и id пользователя
      if (!empty($_SESSION['login']) or !empty($_SESSION['id']))
      {
        // запоминаем ник пользователя
        $message = $_SESSION['login'];
      }
      
      require_once'/blocks/header.php';
    ?>

    <div id="content">

      <script type="text/javascript">
    //  добавляет доп. поля для ввода тестов
    function add_test()
    {
      var div = document.createElement('<input class = "p_input" type="text" name="example_input_data[]"  placeholder="Пример входных данных">'+
                                        '<input class = "p_input" type="text" name="example_output_data[]"  placeholder="Пример выходных данных"><br>');
      $('span').insertAfter('#example');
      alert("lolkek");
      $("#example").append(div);
    }
    add_test();
    alert("lll");
    var btn = document.getElementById('add_ex');
    btn.onclick = function(){
      $("#example").append(div);
    }    
  </script>
      <div id="add_admin">
        <form id="add_adm_form" class="" action="/lib/add_adm.php" method="post">
          <p>Введите логин пользователя, которого хотите назначить модератором</p>
          <input class = "adm_input" type="text" name="login"  placeholder="Введите логин">
          <input class="adm_input" type="submit" name="add_m" value="Назначить модератором"><br>
        </form>
      </div>
      <div id="add_problem">
          <form id="add_problem_form" class="" action="/lib/add_problem.php" method="post">
          
          <input class = "p_input" type="text" name="p_name"  placeholder="Введите название задачи"><br>
          
          <textarea class="p_input" id="input_t" name="p_task" placeholder="Введите условие задачи. (Возможно использование HTML кода)"></textarea><br>
          
          <div id="example">
            <input class = "p_input" type="text" name="example_input_data[]"  placeholder="Пример входных данных">
            <input class = "p_input" type="text" name="example_output_data[]"  placeholder="Пример выходных данных"><br>
          </div>
          <input class = "p_input" id="add_ex" type="button" value="Добавить пример" onclick="add_test();"><br>
          
          <input class = "p_input" type="text" name="input_data[]"  placeholder="Входные данные">
          <input class = "p_input" type="text" name="output_data[]"  placeholder="Выходные данные"><br>
          <input class = "p_input" type="button" id="add_data" value="Добавить данные"><br>
          
          <p>Выберите раздел</p>
          <?php 
            // обращаемся к базе, чтобы взять список доступных языков
            $result = $connect->query("SELECT id, theme FROM themes");
            
            echo '<select class="p_input" id="sel" name="language">';
            while(($myrow = $result->fetch_assoc()) != false){
              echo '<option value="'.$myrow["id"].'">'.$myrow["theme"].'</option>';
            }
            echo '</select><br>';

          ?>
          <input class = "p_input" type="text" name="p_timelimit" id="p_timelimit" placeholder="Ограничение времени (сек)"><br>
          <input class="p_input" type="submit" name="add_p" value="Добавить задачу в базу"><br>
        </form>
        </div>  

      
    </div>
    
    
    <!-- правые блоки сайта -->
   <?php require_once("blocks/sidebar.php") ?>
    
    
    <hr id="horizontal_rule">
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <?php
    //  require_once 'blocks/footer.php';
    ?>
  </div>
</body>
  </html>
