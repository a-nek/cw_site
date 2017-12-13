<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    session_start();
    require_once ("/lib/connect_db.php");

    // берем задачу из базы
			$result = $connect->query("SELECT problems.idproblems, problems.name, problems.task,
											  problems.input_data, problems.output_data,
											  problems.time_limit, problems.memory_limit
									   FROM problems WHERE idproblems=".$_GET['id']);
	
	$task_exists; // 0 - задчи нет в базе, 1 - есть
	
	// выборку делаем именно в начале страницы, чтобы указать в title название задачи, 
	// а уже ниже в коде, перед выводом информации о задаче, проверяем её существование, используя переменную $task_exists
	
	// если запрос вернул не равное нулю число строк (т.е. задача с таким id существует в базе)
	if($result->num_rows != 0){
		$myrow = $result->fetch_assoc();
		$id = $myrow['idproblems'];
		$name = $myrow['name'];
		$task = $myrow['task'];
		$input_data = $myrow['input_data'];
		$output_data = $myrow['output_data'];
		$time_limit = $myrow['time_limit'];
		$memory_limit = $myrow['memory_limit'];
		
		$task_exists = 1;
	}else{
		$task_exists = 0;
	}
?>

  <html>
  <head>
  <title>
    <?php echo $id.". ".$name; ?>
  </title>
  <link rel="stylesheet" href="/css/main.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="/css/problem.css" type="text/css" charset="utf-8">
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
        <?php
			
			if($task_exists != 0){
			
				echo '<h3>'.$name.'</h3>';
				echo '<div class = "limits"><br/> Ограничение по времени: '.$time_limit.' сек.</div>';
				echo '<div class = "text"><br/>'.$task.'</div>';
				echo '<h4><br/>Входные данные <br/></h4>
					<div class = "text">'.$input_data.'</div>
					<h4><br/>Выходные данные <br/></h4>
					<div class = "text">'.$output_data.'</div>
					<br/><h4>Пример</h4>';

			  

				echo '<div class="datatable">
				  <table>
					<tr>
					   <th class="num">№</th> <th class="in">input.txt</th> <th class="out">output.txt</th>
					</tr>';
					
					  $result = $connect->query("SELECT example.example_number, example.input, example.output
												  FROM example WHERE example.problem_id=".$id
												);



					  /*
						В $myrow будет храниться строка вида:
					  */
					  while(($myrow = $result->fetch_assoc()) != false){
						echo '<tr>
							  <td class="num">'.$myrow["example_number"] .'</td>
							  <td class="in">'.$myrow["input"].'</td>
							  <td class="out">'.$myrow["output"].'</td>
							  </tr>';
					  }
					  
				// закрываем теги таблицы и блока datatable    
				echo '</table>
				</div>';
			
			
			
				//  ПРоверяем, авторизован ли пользователь. Если да, то
				//  выводим поля для отправки решения. Иначе предлагаем авторизоваться.
				

			  // Проверяем переменные логина и id пользователя
			  if (empty($_SESSION['login']) or empty($_SESSION['id']))
			  {
				// Выводим ссылки на авторизацию и регистрацию
				echo '
				  <div class="text">Для отправки решения необходимо
					<a href="/enter.php">авторизоваться</a>!</div>';
			  } else {
				$user_login = $_SESSION['login'];
				// обращаемся к базе, чтобы взять список доступных языков
				$result = $connect->query("SELECT id, language FROM languages");


				//Блок, в котором будет осуществляться отправка решения
				echo '<div class="send_solution">
				  <h4><br>Отправить решение</h4>';


				//выводим форму отправки решения
				echo '<form action=/lib/upload.php method=post enctype=multipart/form-data>';
				// выводим выпадающий список
				echo '<select name="language">';
				while(($myrow = $result->fetch_assoc()) != false){
				  echo '<option value="'.$myrow["id"].'">'.$myrow["language"].'</option>';
				}
				echo '</select>';
				echo '<input type=file name=uploadfile>
					  <input type=hidden name=task_num value='.$id.'>
					  <input name = "done" type=submit value=Загрузить></form>';
				

				echo "</div>";
			  }
			  
			// если нет задачи в базе
			}else{
				echo 'Ошибка! Такой задачи в базе не найдено...';
			}
        ?>


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
