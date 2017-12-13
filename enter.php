<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    session_start();
    require_once ("/lib/connect_db.php");

?>
  <html>
  <head>
  <title>Войти на сайт</title>
  <link rel="stylesheet" href="css/main.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="css/auth_form.css" type="text/css" charset="utf-8">
  </head>
  <body>

  <div id="wraper" class="">
    <!-- подключение шапки сайта-->
    <?php
      require_once'/blocks/header.php';
    ?>

    <!-- авторизация пользователя-->
    <?php
    // Проверяем переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
      // если они пусты, то выводим форму авторизации
      echo '<form  action="/lib/auth.php" method="post">
            <input class="signin" name="login" type="text" size="15" maxlength="15" placeholder="Введите ваш логин">
            <br>
            <input class="signin" name="password" type="password" size="15" maxlength="15" placeholder="Введите ваш пароль">
            <br>
            <input  class="button" type="submit" name="submit" value="Войти">';
    }
    else
    {
    /*
      Если не пусты, то пользователь авторизован.
      Перенапрявляем его на главную страницу.
    */
    echo "Вы вошли на сайт, как ".$_SESSION['login']." ";
    header("Location: /index.php ");
    exit;

    }
    ?>

    <!-- подключение подвала сайта-->
    <?php
      //require_once 'blocks/footer.php';
    ?>
  </div>
</body>
  </html>
