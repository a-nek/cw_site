<?php 
	if (isset($_POST['add_m'])) {
  		require_once ("connect_db.php");

  		// проверка на существование пользователя с таким же логином
		$result = $connect->query("SELECT idusers FROM users WHERE login='".$_POST['login']."'");

		$myrow = $result ->fetch_assoc();
		if (empty($myrow['idusers'])) {
		  echo 'Пользователь НЕ назначен модератором. Вернитесь в <a class="links" href="http://localhost/admin.php">Панель администратора</a> и попытайтесь снова';
		}else{
			$result = $connect->query("UPDATE `data_base`.`users` SET `right`='2' WHERE `login`='".$_POST['login']."'");
  			echo 'Пользователь назначен модератором. Вы можете вернуться в <a class="links" href="admin.php"><br>  Панель администратора</a>';
		}
	}
?>