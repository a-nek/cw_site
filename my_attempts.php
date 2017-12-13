<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    session_start();
    require_once ("lib/connect_db.php");


?>

  <html>
  <head>
  <title>Архив задач</title>
  <link rel="stylesheet" href="css/main.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="css/status.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="css/table.css" type="text/css" charset="utf-8">
  </head>
  <body>

  <div id="wraper" class="">
    
    <!-- подключение шапки сайта-->
    <?php
      
      // Проверяем переменные логина и id пользователя
      if (!empty($_SESSION['login']) or empty(!$_SESSION['id']))
      {
        // запоминаем ник пользователя
        $message = $_SESSION['login'];
      }
      
      require_once'/blocks/header.php';
    
    ?>

    <div id="content">
        <div class="datatable">
          <table>
            <tr>
               <th id="date">Дата</th> <th id="name">Автор</th> <th id="task">Задача</th> <th id="res">Результат</th>
               <th id="test_num">Тест</th><th id="lang">Язык</th>
            </tr>
            <?php
              $result = $connect->query("SELECT status.date, users.name, users.login, status.problem_id, results.result, status.test_number, languages.language 
                                         FROM status
                                         INNER JOIN users ON status.user_id = users.idusers
                                         INNER JOIN results ON status.result_id = results.id
                                         INNER JOIN languages ON status.language = languages.id
                                         WHERE users.login = '".$_SESSION['login']."'
                                         ORDER BY status.date DESC");

              
              while(($myrow = $result->fetch_assoc()) != false){
                echo '<tr>
                        <td id="date">'.$myrow["date"] .'</td> 
                        <td id="name">'.$myrow["name"] .'</td> 
                        <td id="task">'.$myrow["problem_id"] .'</td> 
                        <td id="res">'.$myrow["result"] .'</td>
                        <td id="test_num">'.$myrow["test_number"] .'</td>
                        <td id="lang">'.$myrow["language"] .'</td>
                      </tr>';
              }



            ?>
          </table>


        </div>
    </div>

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
