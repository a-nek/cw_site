<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    session_start();
    require_once ("/lib/connect_db.php");
    
?>

  <html>
  <head>
  <title>Главная страница</title>
  <link rel="stylesheet" href="/css/main.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="/css/auth_form.css" type="text/css" charset="utf-8">
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
        <div id="welcome">Добро пожаловать в систему тестирования решений <br> задач по программированию</div>
        <div>
          <?php 
            if (!isset($message)) {
              echo 'Для работы с системой необходимо авторизоваться. Если у Вас нету учетной записи, то вы можете пройти <a href="/sign_up.php">регистрацию</a>';
            }
          ?>
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
