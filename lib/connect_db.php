<?php
  // в этом файле происходит подключение в базе данных

  // константы
  define ('HOST',			"localhost");
  define ('PORT',			"3305");
	define ('DB_USER',		"root");
	define ('DB_PASSWORD',	"root");
	define ('DB',			"data_base");

  // создаем подключение к базе
  $connect =  new mysqli(HOST.':'.PORT, DB_USER, DB_PASSWORD, DB);
?>
