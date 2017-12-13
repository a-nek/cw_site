<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    session_start();
    require_once ("lib/connect_db.php");


?>

  <html>
  <head>
  <title>Все пользователи</title>
  <link rel="stylesheet" href="css/main.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="css/status.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="css/table.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="css/auth_form.css" type="text/css" charset="utf-8">
   <link rel="stylesheet" href="css/no_border_bottom.css" type="text/css" charset="utf-8">
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
               <th id="name">Имя</th> <th id="Логин">Логин</th> <th id="mail">Почта</th> <th id="right">Уровень доступа</th>
               
            </tr>
            <?php
              $result = $connect->query("SELECT `users`.`name`, `users`.`login`, `users`.`mail`, `rights`.`right` FROM `users`
                                          INNER JOIN `rights` ON `users`.`right` = `rights`.`id`");

              
              while(($myrow = $result->fetch_assoc()) != false){
                echo '<tr>
                        <th id="name">'.$myrow["name"].'</th> 
                        <th id="Логин">'.$myrow["login"].'</th> 
                        <th id="mail">'.$myrow["mail"].'</th> 
                        <th id="right">'.$myrow["right"].'</th>
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
