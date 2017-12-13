<?php
  if (isset($_POST['name'])) {
    $name=$_POST['name'];
    if ($name =='') {
      unset($name);
    }      unset($login);

  }
    }

  if (isset($_POST['login'])) {
    $login = $_POST['login'];
    if ($login == '') {
  }

  if (isset($_POST['password'])) {
    $password=$_POST['password'];
    if ($password =='') {
      unset($password);
    }
  }

  if (isset($_POST['mail'])) {
    $mail=$_POST['mail'];
    if ($mail =='') {
      unset($mail);
    }
  }

  //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
  //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
  if (empty($login) or empty($password) or empty($name) or empty($mail)){
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
  }
  //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
  $name = stripslashes($name);
  $name = htmlspecialchars($name);

  $login = stripslashes($login);
  $login = htmlspecialchars($login);

  $password = stripslashes($password);
  $password = htmlspecialchars($password);

  $mail = stripslashes($mail);
  $mail = htmlspecialchars($mail);

  //удаляем лишние пробелы
  $login = trim($login);
  $password = trim($password);
  $name = trim($name);
  $mail = trim($mail);


  // подключаемся к базе
  include ("connect_db.php");
  // проверка на существование пользователя с таким же логином
  $result = $connect->query("SELECT idusers FROM users WHERE login='$login'");


  $myrow = $result ->fetch_assoc();
  if (!empty($myrow['idusers'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
  }
  // если такого нет, то сохраняем данные
  $result2 = $connect->query ("INSERT INTO users (name, login, password,  mail, `right`) 
                                VALUES('$name', '$login', '".md5($password)."', '$mail', '3')");
  // Проверяем, есть ли ошибки
  if ($result2=='TRUE'){
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='/index.php'>Главная страница</a>";
  }
  else {
    echo "Ошибка! Вы не зарегистрированы.";
  }
?>
