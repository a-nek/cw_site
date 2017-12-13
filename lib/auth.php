<?php
  /*
    процедура работает на сессиях.
    заносим введенный пользователем логин в переменную $login,
    если он пустой, то уничтожаем переменную
  */
  session_start();
  if (isset($_POST['login'])) {
    $login = $_POST['login'];
    if ($login == '') {
      unset($login);
    }
  }

  /*
    заносим введенный пользователем пароль в переменную $password,
    если он пустой, то уничтожаем переменную
    если пользователь не ввел логин или пароль,
    то выдаем ошибку и останавливаем скрипт
  */
  if (isset($_POST['password'])) {
    $password=$_POST['password'];
    if ($password =='') {
      unset($password);
    }
  }

  if (empty($login) or empty($password)){
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
  }
  /*
    логин и пароль обрабатываем, чтобы теги и скрипты не работали
  */
  $login = stripslashes($login);
  $login = htmlspecialchars($login);
  $password = stripslashes($password);
  $password = htmlspecialchars($password);
  //удаляем лишние пробелы
  $login = trim($login);
  $password = trim($password);


  // подключаемся к базе
  include ("connect_db.php");

  $result = $connect->query("SELECT * FROM users WHERE login='$login'",$db); //извлекаем из базы все данные о пользователе с введенным логином
  $myrow = $result ->fetch_assoc();

  if (empty($myrow['password'])){
    //если пользователя с введенным логином не существует
    exit ("Извините, введённый вами login или пароль неверный.");
  }else {
    //если существует, то сверяем пароли
    if ($myrow['password']==md5($password)) {
      //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
      $_SESSION['login']=$myrow['login'];
      $_SESSION['id']=$myrow['idusers'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
      echo "Вы успешно вошли на сайт! <a href='/index.php'>Главная страница</a>";
      // перенаправление на главную
      header("Location: /index.php ");
      exit;
    }else {
      //если пароли не сошлись
      exit ("Извините, введённый вами login или пароль неверный.");
    }
  }
?>
