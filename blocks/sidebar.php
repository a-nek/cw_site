  
  <link rel="stylesheet" href="css/auth_form.css" type="text/css" charset="utf-8">

<?php 
      echo'<div id="sidebar" class="">';
      // если сущ-т переменная, значит пользователь авторизован
      if(isset($message)){
        // узнаем кол-во решенных задач
        $successful = $connect->query("SELECT count(*) as total FROM status 
                        inner join users ON status.user_id = users.idusers
                        where users.login = '".$_SESSION['login']."'
                        and status.result_id = '1'");
        
        if(($myrow = $successful->fetch_assoc()) !=false){
          $successful = $myrow["total"];
        }
        
        // узнаем права пользователя
        $right = $connect->query("SELECT `users`.`right` FROM data_base.users where `login`='".$_SESSION['login']."'");
        if(($myrow = $right->fetch_assoc()) !=false){
          $right = $myrow["right"];
        }
          echo '
            <div id="u_links">
              <span>Решено задач '.$successful.'</span><br>
              
                <a class="links" href="/my_tasks.php"><br>  Мои задачи</a>
                <a class="links" href="/my_attempts.php"><br> Мои попытки</a>
                <a class="links" href="/lib/session_destroy.php"><br> Выход</a>
              
            </div>
            <div id="ico">
              <img  src="ico/user.png" alt="">
              <div id="nickname">'.$message.'</div>
            </div>
          </div>';
          
          // если у пользователя достаточно прав (1 - админ, 2 - модератор, 3 - пользователь)
          if($right < 3){
              echo '
              <div id="sidebar1" class="">
                <div class="u_links">
                  <a class="links" href="admin.php"><br>   Панель администратора</a>
                  <a class="links" href="all_users.php"><br>   Все пользователи</a>
                </div>
              </div>';
          }
      }else{
        // если они пусты, то выводим форму авторизации
      echo '<form  action="/lib/auth.php" method="post">
            <input class="signin" name="login" type="text" size="15" maxlength="15" placeholder="Введите ваш логин">
            <br>
            <input class="signin" name="password" type="password" size="15" maxlength="15" placeholder="Введите ваш пароль">
            <br>
            <input  class="button" type="submit" name="submit" value="Войти">
            <a id="reg" href="/sign_up.php">Регистрация</a>';
      }
      echo'</div>'
    ?>