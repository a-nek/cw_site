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
  <link rel="stylesheet" href="css/sign_up.css" type="text/css" charset="utf-8">
  </head>
  <body>

  <div id="wraper" class="">
    <!-- подключение шапки сайта-->
    <?php
      require_once'/blocks/header.php';
    ?>

    <!-- регистрация пользователя-->
    <form id="sign_up_form" class="" action="/lib/add_user.php" method="post">
      <input class = "reg_input" type="text" name="name"  placeholder="Введите Ваше имя"><br>
      <input class = "reg_input" type="text" name="login" maxlength="15" placeholder="Введите логин"><br>
      <input class = "reg_input" type="password" name="password" maxlength="15" placeholder="Введите пароль"><br>
      <input class = "reg_input" type="password" name="password2" maxlength="15" placeholder="Подтверждение пароля"><br>
      <input class = "reg_input" type="text" name="mail" placeholder="Введите E-mail"><br>
      <input class="button" type="submit" name="submit" value="Зарегистрироваться">
    </form>

    <!-- подключение подвала сайта-->
    <?php
      //require_once 'blocks/footer.php';
    ?>
  </div>
</body>
  </html>