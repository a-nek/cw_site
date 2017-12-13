<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Регистрация</title>
  </head>
  <body>
    <!-- add_user.php - обработчик, который отправит данные пользователя в базу -->
    <form class="" action="/lib/add_user.php" method="post">
      <input class = "reg_input" type="text" name="name"  placeholder="Введите Ваше имя">
      <input class = "reg_input" type="text" name="login" maxlength="15" placeholder="Введите логин">
      <input class = "reg_input" type="password" name="password" maxlength="15" placeholder="Введите пароль">
      <input class = "reg_input" type="password" name="password2" maxlength="15" placeholder="Подтверждение пароля">
      <input class = "reg_input" type="text" name="mail" placeholder="Введите E-mail">
      <input type="submit" name="submit" value="Зарегистрироваться">
    </form>
  </body>
</html>
