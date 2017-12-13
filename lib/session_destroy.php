<?php
  session_start(); // запускаем сессию, чтобы получить доступ к $_SESSION
  $_SESSION = array(); //Очищаем сессию
  session_destroy(); //Уничтожаем
  header("Location: /index.php "); //перенаправление на главную
  exit;
?>
