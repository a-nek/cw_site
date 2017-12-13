<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    session_start();
    require_once ("lib/connect_db.php");


?>

  <html>
  <head>
  <title>Архив задач</title>
  <link rel="stylesheet" href="css/main.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="css/task_archive.css" type="text/css" charset="utf-8">
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
               <th id="num">№</th> <th id="name">Название</th> <th id="theme">Тема</th> <th id="decided">Решили</th>
            </tr>
            <?php
              $result = $connect->query("SELECT problems.idproblems, problems.name, themes.theme, problems.successful_attempts FROM problems
                                        INNER JOIN themes ON problems.theme_id = themes.id");

              /*
                В $myrow будет храниться строка вида:  Array ( [idproblems] => 1 [name] => A + B [theme] => Задачи для начинающих [successful_attempts] => 0 )
              */
              while(($myrow = $result->fetch_assoc()) != false){
                echo '<tr>
                        <td class="num">'.$myrow["idproblems"] .'</td>
                        <td class="name"><a href="/problem.php?id='.$myrow["idproblems"].'">'.$myrow["name"].'</a></td>
                        <td class="theme">'.$myrow["theme"].'</td>
                        <td class="decided">'.$myrow["successful_attempts"].'</td>
                      </tr>';
              }



            ?>
          </table>


        </div>
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
