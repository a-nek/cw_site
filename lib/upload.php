<?php
    session_start();

if(isset($_POST['done'])){
// Каталог, в который мы будем принимать файл:
$uploaddir = './tmp_upload/';
$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);

// Выводим информацию о загруженном файле:
/*echo "<h3>Информация о загруженном на сервер файле: </h3>";
echo "<p><b>Оригинальное имя загруженного файла: ".$_FILES['uploadfile']['name']."</b></p>";
echo "<p><b>Mime-тип загруженного файла: ".$_FILES['uploadfile']['type']."</b></p>";
echo "<p><b>Размер загруженного файла в байтах: ".$_FILES['uploadfile']['size']."</b></p>";
echo "<p><b>Временное имя файла: ".$_FILES['uploadfile']['tmp_name']."</b></p>";
echo "<p><b>Имя пользователя: ".$_SESSION['login']."</b></p>";
echo "<p><b>Содержимое файла: ".file_get_contents($_FILES['uploadfile']['tmp_name'])."</b></p>";
*/


// читаем файл построчно и после каждой строки 
// вставляем переход на новую строку \r\n
// Делаем именно так, из-за того, что
//  file_get_contents читает файл в 
// одну строку и ,если в исходном коде 
// есть комментарии ,то это приведет к 
// ошибке при компиляции

$f = fopen($_FILES['uploadfile']['tmp_name'], "r");
$file_contents = "";
	// Читать построчно до конца файла
	while(!feof($f)) { 
	    $file_contents .= fgets($f) . PHP_EOL;
	}

fclose($f);
echo $file_contents;
        
// подключаем файл, который содержит функцию отправки данных на java сервер
require_once 'send_to_server.php';

// вызываем функцию
   send_to_server($_SESSION['login'], $_POST['task_num'], $_FILES['uploadfile']['name'], $file_contents, $_POST['language']);

   header("Location:".$_SERVER[HTTP_REFERER]);
}

/*
// Копируем файл из каталога для временного хранения файлов:
if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile))
{
echo "<h3>+++++Файл успешно загружен на сервер</h3>";
}
else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>"; exit; }*/
?>
